/*
* editTable.js
*/
;(function($,global){

    var objToArray = function(obj){
        var arr = [];
        for(var x in obj){
            arr.push(obj[x]);
        }
        return arr;
    },
        requiredRender = function(hot, td, row, col, prop, value, cellProperties){
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            td.className += 'required';
            //td.style.backgroundColor = 'yellow';
        };

    var ExcelTable = function(element,options){
        var that = this;

        this.element = element;
        this.hot = null;
        this.edit = null;
        this.defaults = {
            bindData    :   {},
            rows        :   [],
            url         :   {
                save    :   '',
                delete  :   ''
            },
            columns     :   {},
            tableClassName : '',
            afterSave   :   function(resp){},
            beforeSave  :   function(data){}
        };

        this.options = $.extend({},this.defaults,options);
        this.rows = this.options.rows;
        //this.cols = objToArray(that.options.columns);
        var colHeaders = [],
            columns = [];
        for(var x in this.options.columns){
            if(this.options.columns[x].hasOwnProperty('label')){
                colHeaders.push(this.options.columns[x].label);
            }else{
                colHeaders.push(x);
            }
            columns.push($.extend({data:x},this.options.columns[x]));
        }
        this.cols = columns;
        var hotOptions = {
            data        :   options.rows,
            colHeaders  :   colHeaders,
            afterChange :   function(changes,source){
                if(source !== 'loadData'){
                    that.save(changes);
                }
            },
            beforeRemoveRow:function(index,amount){
                that.delete(index,amount);
            },
            columns     :  columns ,
            minSpareRows:   1,
            contextMenu: ['remove_row'],
            cells: function (row, col, prop) {
                if(col < that.cols.length && that.cols[col].required){
                    this.renderer = requiredRender;
                }
            },
            tableClassName  :   this.options.tableClassName,
            width   :   '100%',
            stretchH: "all",
            colWidths   :   this.options.colWidths
        };

        if(typeof Handsontable === "function"){
            this.hot = new Handsontable(this.element,hotOptions);
        }

        $('body').bind('add.'+$(element).attr('id'),function(e,row){
            that.rows.splice(that.rows.length-1,0,row);
            that.hot.render();
        });
        $(element).bind('table.render',function(){
            that.hot.render();
        });
    };

    ExcelTable.prototype = {
        constructor :   ExcelTable,
        post    :   function(data){
            var that = this;
            var ret = this.options.beforeSave(data);
            if(typeof ret === "object"){
                data = ret;
            }
            if(data.id){
                data.action = 'edit';
            }else{
                data.id = '';
                data.action = 'edit';
            }
            if(this.options.url.save){
                $.post(this.options.url.save,data,function(resp){
                    if(!data.id && resp.id !== null){
                        // 新建了记录，重新渲染
                        that.options.rows[resp.index].id = resp.id;
                        that.hot.render();
                    }
                    that.options.afterSave(resp);
                },'json');
            }
        },
        getDelete   :   function(ids){
            if(this.options.url.delete){
                $.get(this.options.url.delete+'?id='+ids,function(resp){

                });
            }
        },
        save    :   function(cells){
            var that = this,
                rows = [];
            cells.forEach(function(cell){
                if(cell[2] !== cell[3]){
                    rows[cell[0]] = cell[0];
                }
            });
            rows.forEach(function(rowIndex){
                var row = that.rows[rowIndex],
                    data = $.extend(row,that.options.bindData);
                data.index = rowIndex;
                if(that.validate(row)){
                    console.log(data);
                    that.post(data);
                }
            });
        },
        delete  :   function(start,amount){
            var ids = [];
            for(var x = start;x < start + amount;x++){
                ids.push(this.rows[x].id);
            }
            this.getDelete(ids.join(','));
        },
        validate   :   function(row){
            var that = this;
            return that.cols.filter(function(col,index){
                    if(row.hasOwnProperty(col.data)){
                        var valitator = that.hot.getCellValidator(0,index);
                        if(col.required){
                            if(!row[col.data]) return true;
                            if(valitator){
                                return !that.execValidator(valitator,row[col.data]);
                            }
                            return false;
                        }else if(row[col.data] && valitator){
                            return !that.execValidator(valitator,row[col.data]);
                        }else{
                            return false;
                        }
                    }
                    else{
                        return false;
                    }
                }).length == 0;
        },
        execValidator:function(validator,value){
            if(validator instanceof RegExp === true){
                return validator.test(value);
            }else if(typeof  validator === "function"){
                return validator(value,function(){});
            }else{
                return false;
            }
        },

        isEmptyRow  :   function(rowIndex){
            var rowData = this.hot.getData()[rowIndex];

            for (var i = 0, ilen = rowData.length; i < ilen; i++) {
                if (rowData[i] !== null) {
                    return false;
                }
            }
            return true;
        }
    };

    $.fn.initEdit = function(options){
        return this.each(function(){
            var excelTable = new ExcelTable(this,options);
        });
    }

})($ || jQuery,window);