<form wire:submit="save">
    <div class="box border-success m-0">
        <div class="box-body py-0">
            <div class="vtabs">
                <ul class="nav nav-tabs tabs-vertical bl-1 border-primary" role="tablist">

                    @foreach ($tags as $tag)
                        <li class="nav-item">
                            <a class="nav-link !active-success py-1 @if ($selectedTag == $tag) active @endif"
                                data-bs-toggle="tab" href="#{{ $tag }}" role="tab"
                                wire:click="$set('selectedTag','{{ $tag }}')">
                                <span>
                                    {{ __('site.panel_permissions_api.tags.' . $tag) }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-20">
                    @foreach ($tags as $tag)
                        <div class="tab-pane @if ($selectedTag == $tag) active @endif"
                            id="{{ $tag }}" role="tabpanel">
                            <div class="row">
                                @foreach ($permissions[$tag] as $key => $value)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="switch switch-success">
                                                <input type="checkbox"
                                                    wire:model="permissions.{{ $tag }}.{{ $key }}"
                                                    @if ($value) checked @endif>
                                                <span class="switch-indicator"></span>
                                            </label>

                                            <label for="show_profile" class="form-label">
                                                {{ __("site.panel_permissions_api.{$key}") }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">

                <a href="#" data-bs-dismiss="modal" class="btn btn-danger"
                    wire:click="buttonCancelClicked">
                    {{ __('website.cancel') }}
                </a>

                <button type="submit" class="btn btn-success">
                    {{ __('website.update') }}
                </button>
            </div>
        </div>
    </div>
</form>
