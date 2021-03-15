<footer class="footer bg-dark text-white">
    <div class="container">
      

      <div class="row">
        <div class="col-md-2 footerLogo">
          <a></a>
        </div>
        <div class="col-md-4">
          <h6 class="text-white">Email: support@chowk.com.bd</h6>
          <p>Give Your Feedback</p>
        </div>
        <div class="col-md-3">
          <h5 class="text-white">Chowk Bangladesh</h5>
          <ul class="text-white">
            <li><a class="text-white" href="">About us</a></li>
            <li><a class="text-white" href="">Contact us</a></li>
            <li><a class="text-white" href="">Career</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="text-white">Help & Support</h5>
          <ul class="text-success">
            <li><a class="text-white" href="">Terms of Service</a></li>
            <li><a class="text-white" href="">privecy Policy</a></li>
            <li><a class="text-white" href="">FAQ</a></li>
          </ul>
        </div>
        </div>

      <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
          <div class="copyright">
            &copy; 2021 <a class="text-white" href="/" target="_blank">{{ config('global.site_name', 'mResto') }}</a>
          </div>
        </div>
        <div class="col-md-6">
          <ul id="footer-pages" class="nav nav-footer justify-content-end">
            <li v-for="page in pages" class="nav-item" v-cloak>
              <a :href="'/pages/' + page.id" class="nav-link">@{{ page.title }}</a>
            </li>
            @if (!config('settings.single_mode')&&config('settings.restaurant_link_register_position')=="footer")
              <li class="nav-item">
                <a  target="_blank" class="button nav-link nav-link-icon" href="{{ route('newrestaurant.register') }}">{{ __(config('settings.restaurant_link_register_title')) }}</a>
              </li>
            @endif
            @if (config('app.isft')&&config('settings.driver_link_register_position')=="footer")
              <li class="nav-item">
                <a target="_blank" class="button nav-link nav-link-icon" href="{{ route('driver.register') }}">{{ __(config('settings.driver_link_register_title')) }}</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
      </div>
    </div>
  </footer>