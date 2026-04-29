 <div>
      <div class="custom-card-two" style="margin:5px 35px 35px 35px;padding:25px;">
         <div class="box box-warning">
             <div class="box-body text-center">
                 <a href="{{ route('theme_two.system',['system' => $plan->type == 1 ? 2 : 1]) }}"
                     class="btn btn-success  text-bold" style="padding:10px;margin:5px;width:100px;">
                     <span class="text-white">
                         {{ trans('site.home_index.change_system') }}
                     </span>
                 </a>
                 <h4 class="box-title">
                     <span class="text-white h3">
					 <strong>
                         {{ __('site.home_index.current_system_xs.' . $plan->type) }}
					 </strong>
                     </span>
                 </h4>
             </div>
         </div>
     </div>
 <div class="custom-card-container">

		 <div class="custom-card box-body text-center py-xs-1"  >
			<div style="display:flex;justify-content:center;margin:15px 5px;">
                 <h4 class="box-title text-center">

                     <span class="text-white h3" style="font-weight:bold;">
                         {{trans('theme_two.register_info.plan_details')}}
                     </span>
					 <span>
						<a href="{{ route('theme_two.system', $plan->type) }}"
                             class="btn px-4 btn-info text-bold" style="padding:7px;margin:5px;width:80px;" >
                             <span class="text-danger">
                                 {{ trans('site.home_index.change_system') }}
                             </span>
                        </a>
                     </span>
                 </h4>
			</div>
			<div style="display:block;">
                 <div  class="custom-table" >
                     <div class="text-white fw-bold custom-table-col" >
                         <div class="py-0 text-wrap" style="font-weight:bold;">
                             {{ trans('site.cafe_branches.create.plans.price') }}
                         </div>
                         <div class="py-0 fs-18">
                             {{ $plan->price }}
                         </div>
                     </div>
                     <div class="text-white fw-bold custom-table-col" >
                         <div class="py-0 text-wrap" style="font-weight:bold;">
                             {{ trans('site.cafe_branches.create.plans.users') }}
                         </div>
                         <div class="py-0 fs-18">
                             {{ $plan->users }}
                         </div>
                     </div>
                     <div class="text-white fw-bold custom-table-col" >
                         <div class="py-0 text-wrap" style="font-weight:bold;">
                             {{ trans('site.cafe_branches.create.plans.cards') }}
                         </div>
                         <div class="py-0 fs-18">
                             {{ $plan->cards }}
                         </div>
                     </div>
                 </div>
			</div>
           </div>

     <div class="custom-card box-body text-center py-xs-1">
    <div style="display:flex;justify-content:center;margin:15px 5px;">
        <h4 class="box-title text-center">
            <span class="text-white h3" style="font-weight:bold;">
                {{trans('theme_two.register_info.system_details')}}
            </span>
            <span>
                <a href="{{ route('theme_two.system', $plan->type) }}" class="btn px-4 btn-info text-bold" style="padding:7px;margin:5px;width:80px;" >
                    <span class="text-danger">
                        {{ trans('site.home_index.change_system') }}
                    </span>
                </a>
            </span>
        </h4>
    </div>
    <div style="display:block;">
        <div class="custom-table">
            <div class="text-white fw-bold custom-table-col">
                <div class="py-0 text-wrap" style="font-weight:bold;">
                   {{trans('theme_two.register_info.system_name')}}
                </div>
                <div class="py-0 fs-18">
                    {{ __('site.home_index.current_system.' . $plan->type) }}
                </div>
            </div>
            <div class="text-white fw-bold custom-table-col">
                <div class="py-0 text-wrap" style="font-weight:bold;">
                    {{trans('theme_two.register_info.system_status')}}
                </div>
                <div>
                    {{trans('theme_two.register_info.stable')}}
                </div>
            </div>
            <div class="text-white fw-bold custom-table-col">
                <div class="py-0 text-wrap" style="font-weight:bold;">
                    {{trans('theme_two.register_info.data_security')}}
                </div>
                <div>
                    {{trans('theme_two.register_info.yes')}}
                </div>
            </div>
        </div>
    </div>
</div>


 </div>

@push('styles')
<style>


.custom-card {
    background-color: #34495e;
    color: #ffffff;
    border-radius: 10px;
    padding: 10px 20px 30px 20px;
	margin-top:15px;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: -8px 10px 14px rgba(0, 0, 0, 0.3), -6px 0px 10px rgba(0, 0, 0, 0.1);
}

.custom-card-two {
    background-color: #e9c12a;
    color: white;
    border-radius: 10px;
    padding: 10px 15px;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: -6px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Hover effects */
.custom-card:hover {
    background-color: #2c3e50;
    color: #ffffff;
    transform: translateY(-5px);
    box-shadow: -8px 15px 18px rgba(0, 0, 0, 0.4), -6px 0px 12px rgba(0, 0, 0, 0.2);
}

.custom-card-two:hover {
    background-color: #2c3e55;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: -8px 15px 18px rgba(0, 0, 0, 0.4), -6px 0px 12px rgba(0, 0, 0, 0.2);
}



.custom-table
{
	border-radius:10px !important;
	display:grid;
	grid-template-columns:1fr;
	padding:15px 5px;
	background-color:e9c12a;
	color:34495e;
	line-height:1.5;
}
.custom-table-col
{
	border-bottom:1px solid white;
	display:grid;
	grid-template-columns:2fr 1fr;
	padding:10px;

}

.custom-card-container
{
	display:block;
	padding-bottom:50px;
	border-bottom:1px solid gray;
}

 @media (min-width: 768px) {
 .custom-card-container {
	display:grid;
	grid-template-columns:1fr 1fr;
	grid-gap:20px;

 }
}

</style>

@endpush
