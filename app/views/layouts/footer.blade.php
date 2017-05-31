<div class="modal" id="base-modal" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
@yield('modals','')
{{$ctrl->getStyleHtml()}}
@yield('styles','')
{{HTML::script('js/bootstrap.min.js')}}
{{$ctrl->getScriptHtml()}}
@yield('scripts','')
{{HTML::script('js/common.js')}}