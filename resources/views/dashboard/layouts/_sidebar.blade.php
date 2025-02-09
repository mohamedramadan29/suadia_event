  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow " data-scroll-to-active="true">
      <div class="main-menu-content">
          <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
              <li class="nav-item {{ Route::is('dashboard.welcome') ? 'active' : '' }}"><a
                      href="{{ route('dashboard.welcome') }}"><i class="la la-home"></i><span class="menu-title"
                          data-i18n="nav.dash.main">الرئيسية</span></a>

              </li>

              @can('admins')
                  <li class="nav-item{{ Route::is('dashboard.collages.*') ? 'active' : '' }}"><a href="#"><i
                              class="la la-building"></i><span class="menu-title" data-i18n="nav.users.main"> الكليات
                          </span></a>
                      <ul class="menu-content">
                          <li class="{{ Route::is('dashboard.collages.index') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.collages.index') }}"
                                  data-i18n="nav.users.user_profile"> الكليات
                              </a>
                          </li>
                          <li class="{{ Route::is('dashboard.collages.create') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.collages.create') }}"
                                  data-i18n="nav.users.user_cards"> اضافة كلية </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item{{ Route::is('dashboard.events_types.*') ? 'active' : '' }}"><a href="#"><i
                              class="la la-building"></i><span class="menu-title" data-i18n="nav.users.main"> انواع
                              الفعاليات
                          </span></a>
                      <ul class="menu-content">
                          <li class="{{ Route::is('dashboard.events_types.index') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.events_types.index') }}"
                                  data-i18n="nav.users.user_profile"> انواع الفعاليات
                              </a>
                          </li>
                          <li class="{{ Route::is('dashboard.events_types.create') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.events_types.create') }}"
                                  data-i18n="nav.users.user_cards"> اضافة نوع </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item{{ Route::is('dashboard.events.*') ? 'active' : '' }}"><a href="#"><i
                              class="la la-building"></i><span class="menu-title" data-i18n="nav.users.main"> الفعاليات
                          </span></a>
                      <ul class="menu-content">
                          <li class="{{ Route::is('dashboard.events.index') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.events.index') }}"
                                  data-i18n="nav.users.user_profile"> جميع الفعاليات
                              </a>
                          </li>
                          <li class="{{ Route::is('dashboard.events.create') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.events.create') }}"
                                  data-i18n="nav.users.user_cards"> اضافة فعالية </a>
                          </li>
                      </ul>
                  </li>
              @endcan

              @can('roles')
                  <li class="nav-item {{ Route::is('dashboard.roles.*') ? 'active' : '' }}"><a href="#"><i
                              class="la la-television"></i><span class="menu-title" data-i18n="nav.role.main"> الصلاحيات
                          </span></a>
                      <ul class="menu-content">
                          <li class="{{ Route::is('dashboard.roles.index') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.roles.index') }}" data-i18n="nav.role.index">
                                  جميع الصلاحيات </a>
                          </li>
                          <li class="{{ Route::is('dashboard.roles.create') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.roles.create') }}"
                                  data-i18n="nav.templates.vert.classic_menu"> <i class="la la-plus"></i> <span
                                      class="menu-title""> اضافة صلاحية </a>
                          </li>
                      </ul>
                  </li>
              @endcan


              @can('admins')
                  <li class="nav-item{{ Route::is('dashboard.admins.*') ? 'active' : '' }}"><a href="#"><i
                              class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main"> الموظفين
                          </span></a>
                      <ul class="menu-content">
                          <li class="{{ Route::is('dashboard.admins.index') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.admins.index') }}"
                                  data-i18n="nav.users.user_profile"> الموظفين
                              </a>
                          </li>
                          <li class="{{ Route::is('dashboard.admins.create') ? 'active' : '' }}">
                              <a class="menu-item" href="{{ route('dashboard.admins.create') }}"
                                  data-i18n="nav.users.user_cards"> اضافة موظف </a>
                          </li>
                      </ul>
                  </li>
              @endcan


              <li class="nav-item {{ Route::is('dashboard.update_profile.*') ? 'active' : '' }}"><a href="#"><i
                          class="la la-user"></i><span class="menu-title" data-i18n="nav.users.main"> ادارة
                          حسابي
                      </span></a>
                  <ul class="menu-content">
                      <li class="{{ Route::is('dashboard.update_profile') ? 'active' : '' }}">
                          <a class="menu-item" href="{{ route('dashboard.update_profile') }}"
                              data-i18n="nav.users.user_profile"> تعديل البيانات
                          </a>
                      </li>
                      <li class="{{ Route::is('dashboard.update_password') ? 'active' : '' }}">
                          <a class="menu-item" href="{{ route('dashboard.update_password') }}"
                              data-i18n="nav.users.user_profile"> تعديل كلمة المرور
                          </a>
                      </li>
                  </ul>
              </li>

          </ul>
      </div>
  </div>
