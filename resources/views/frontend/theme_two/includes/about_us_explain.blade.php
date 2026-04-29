<!-- About us Explanation section start -->
<div class="section primary-section" id="portfolio">
    <div class="triangle"></div>
    <div class="container">
        <div class="title">
            <h1>{{trans('theme_two.about_us_explain.title')}}</h1>
            <p>{{trans('theme_two.about_us_explain.body')}}</p>
        </div>
        <div class="row-fluid team">
            <div class="span4" id="first-person">
                <div class="thumbnail">

                    <h3>{{trans('theme_two.about_us_explain.one.title')}}</h3>
                    <ul class="social">
                    <p>{{trans('theme_two.about_us_explain.one.body')}}</p>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/NUB8bNw15uI" frameborder="0" allowfullscreen></iframe>
                            <a href="https://www.youtube.com/embed/NUB8bNw15uI">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/embed/NUB8bNw15uI">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/embed/NUB8bNw15uI">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="mask">
                        <h2>{{trans('theme_two.about_us_explain.one.title')}} </h2>

                    </div>
                </div>
            </div>
            <div class="span4" id="second-person">
                <div class="thumbnail">

                    <h3>{{trans('theme_two.about_us_explain.two.title')}}</h3>
                    <ul class="social">
                    <p>{{trans('theme_two.about_us_explain.two.title')}}</p>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/N-8fkxf0Wl8" frameborder="0" allowfullscreen></iframe>

                            </ul>
                    <div class="mask">
                        <h2>{{trans('theme_two.about_us_explain.two.title')}}</h2>
                            </li>
                        <li>
                            <a href="https://www.youtube.com/embed/N-8fkxf0Wl8">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/embed/N-8fkxf0Wl8">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="span4" id="third-person">
                <div class="thumbnail">

                    <h3>{{trans('theme_two.about_us_explain.three.title')}}</h3>
                    <ul class="social">
                    <p>{{trans('theme_two.about_us_explain.three.title')}}</p>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/O5AfnQRhXLo" frameborder="0" allowfullscreen></iframe>
                            <a href="https://www.youtube.com/embed/NUB8bNw15uI">
                                <span class="icon-facebook-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/embed/O5AfnQRhXLo">
                                <span class="icon-twitter-circled"></span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/embed/O5AfnQRhXLo">
                                <span class="icon-linkedin-circled"></span>
                            </a>
                        </li>
                    </ul>
                    <div class="mask">
                        <h2>{{trans('theme_two.about_us_explain.three.title')}}</</h2>

                    </div>
                </div>
            </div>
        </div>
		
		
<!-- Features -->
<div class="about-text centered">
	<h1 style="box-shadow: 0px 8px 16px 0px #e9c12a;max-width:70%;margin:auto; margin-top:150px; margin-bottom:50px;text-align: center;color:white;padding:4%;padding-top:2%;;border-radius:20px;background-color:#1f1f1f;">
              <div style="text-align: center;"><font size="3"><b>&nbsp;</b></font></div>
			 <p style="padding:15px;"> <b ><font size="5" color="#ffff00">{{trans('theme_two.about_us_explain.features.feature1')}} </font></b></p>
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

    </div>
</div>
