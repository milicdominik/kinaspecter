				<nav class="site-nav">
					<ul class="group">
						<li><a href="{{route('naslovna')}}" class="@yield('Naslovna')">Naslovna</a></li>
						<li><a href="{{route('onama')}}" class="@yield('ONama')">O nama</a></li>
						<li><a href="{{route('galerija')}}" class="@yield('Galerija')">Galerija slika</a></li>
						<li class="hide-small"><a href="{{route('dvorane')}}" class="@yield('Dvorane')">Dvorane</a>
							<ul>
								<li><a href="{{route('mala')}}" class="@yield('MalaDvorana')">Mala dvorana</a></li>
								<li><a href="{{route('srednja')}}" class="@yield('SrednjaDvorana')">Srednja dvorana</a></li>
								<li><a href="{{route('velika')}}" class="@yield('VelikaDvorana')">Velika dvorana</a></li>
								<li><a href="{{route('vip')}}" class="@yield('VIPDvorana')">VIP dvorana</a></li>
							</ul></li>
						<li class="hide-small"><a href="{{route('cjenik')}}" class="@yield('Cjenik')">Cjenik</a></li>
						<li><a href="{{route('kontakt')}}" class="@yield('Kontakt')">Kontakt</a></li>
					</ul>
				</nav>
			</div>
		</header>
