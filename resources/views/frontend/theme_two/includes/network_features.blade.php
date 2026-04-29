<div class="about-text centered">
	<h1 style="box-shadow: 0px 8px 16px 0px #1f1f1f;text-align: center;color:white;margin:30px;padding:4%;padding-top:0;border-radius:20px;background-color:#1f1f1f;">
		<div style="text-align: center;"><font size="3">&nbsp;</font></div>
		<div style="text-align:center;font-weight:bold;padding:35px;"><font size="5" >
		{{trans('theme_two.about_us_explain.features.feature1')}}
        </font></div>
		<!-- Features -->
				@foreach(range(2, 40) as $index)
					<div style="text-align: center;">
					<font size="3">👍</font>
						@if(trans("theme_two.about_us_explain.features.feature$index") !== "")
							<b><font size="3">{{ trans("theme_two.about_us_explain.features.feature$index") }}</font></b>
						@endif
						<font size="3"><b>⚪</b></font>
					</div>
				@endforeach
			</h1>
            {{-- triangle look --}}
                <div class="triangle"></div>
                <div class="container centered"></div>
            {{-- / triangle look --}}
    </div>