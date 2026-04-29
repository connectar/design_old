<div class="box">
    <div class="box-header text-center">

        <div class="logo-box">
            <!-- Logo -->
            <a href="" class="logo">
                <div class="logo-lg">
                    <span class="dark-logo">
                        <img class="w-30" src="{{ asset('images/logo-letter.png') }}" alt="logo">
                    </span>
                    <span class="dark-logo">
                        <img src="{{ asset('images/logo-light-text.png') }}" alt="logo">
                    </span>
                </div>
            </a>
        </div>

    </div>
    <!-- /.box-header -->

    <div class="box-body wizard-content">
        <div class="tab-wizard wizard-circle wizard clearfix">
            <div class="steps clearfix">
                <ul role="tablist">
                    @foreach ($steps as $index => $step)
                        <li role="tab"
                            class="@if ($step == $currentStep) first current @else disabeld @endif"
                            aria-disabled="false"
                            aria-selected="@if ($step == $currentStep) true @else false @endif">
                            <a href="#">
                                <span class="step badge badge-info">
                                    {{ $index + 1 }}
                                </span>
                                {{ __('site.nas_install.steps.' . $step) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="content clearfix">
                <div class="row">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            @include("backend.admins.nas.includes.coova_install.steps.{$currentStep}")
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
