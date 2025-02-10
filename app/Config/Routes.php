<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/',                   'LandingPage::index');
$routes->group('apps', static function ($routes) {
    $routes->get('/',                   'LandingPage::index');

    $routes->group('landing', static function ($routes) {
        $routes->get('/',                   'LandingPage::index');
        $routes->get('informasi',           'Apps\Pengumuman::getAllData');
        $routes->get('panduan',             'LandingPage::Panduan');
        $routes->get('galeri',              'LandingPage::Galeri');
        $routes->get('getalldatagaleri',    'Apps\Galeri::getAllDataGaleri');

        $routes->get('login',              'LandingPage::Login');
        $routes->get('register',           'LandingPage::Register');

        $routes->post('ceklogin',           'LandingPage::CekLogin');
    });

    $routes->group('pagemember', static function ($routes) {
        $routes->get('/',               'MemberPage::index');
        $routes->get('addmember',       'MemberPage::AddMember');
        $routes->get('pengumuman',      'MemberPage::PengmumumanMember');
    });

    $routes->group('dashboard', static function ($routes) {
        $routes->get('/',               'Apps\Dashboard::index');
    });

    $routes->group('admin', static function ($routes) {
        $routes->get('/',               'Apps\Admin::index');

        $routes->post('getshowdata',    'Apps\Admin::getShowData');
        $routes->get('getbyId/(:num)',  'Apps\Admin::getById/$1');

        $routes->post('insert',         'Apps\Admin::InsertData');
        $routes->post('update',         'Apps\Admin::UpdateData');
        $routes->post('delete',         'Apps\Admin::DeleteData');
    });

    $routes->group('member', static function ($routes) {
        $routes->get('/',               'Apps\Member::index');

        $routes->post('getshowdata',    'Apps\Member::getShowData');
        $routes->get('getbyId/(:num)',  'Apps\Member::getById/$1');

        $routes->post('insert',         'Apps\Member::InsertData');
        $routes->post('update',         'Apps\Member::UpdateData');
        $routes->post('delete',         'Apps\Member::DeleteData');
    });

    $routes->group('galeri', static function ($routes) {
        $routes->get('/',               'Apps\Galeri::index');

        $routes->post('getshowdata',    'Apps\Galeri::getShowData');
        $routes->get('getbyId/(:num)',  'Apps\Galeri::getById/$1');

        $routes->post('insert',         'Apps\Galeri::InsertData');
        $routes->post('update',         'Apps\Galeri::UpdateData');
        $routes->post('delete',         'Apps\Galeri::DeleteData');
    });

    $routes->group('pengumuman', static function ($routes) {
        $routes->get('/',               'Apps\Pengumuman::index');

        $routes->post('getshowdata',    'Apps\Pengumuman::getShowData');
        $routes->get('getbyId/(:num)',  'Apps\Pengumuman::getById/$1');

        $routes->post('insert',         'Apps\Pengumuman::InsertData');
        $routes->post('update',         'Apps\Pengumuman::UpdateData');
        $routes->post('delete',         'Apps\Pengumuman::DeleteData');
    });

    $routes->group('pendaftar', static function ($routes) {
        $routes->get('/',                       'Apps\Pendaftar::index');
        $routes->get('lulus',                   'Apps\Pendaftar::Lulus');
        $routes->get('tidaklulus',              'Apps\Pendaftar::Tidaklulus');

        $routes->post('getshowdata',            'Apps\Pendaftar::getShowData');
        $routes->get('getbyId/(:num)',          'Apps\Pendaftar::getById/$1');

        $routes->post('status',                 'Apps\Pendaftar::updateStatus');
        $routes->post('getshowdatalulus',       'Apps\Pendaftar::getShowDataLulus');
        $routes->post('getshowdatatidaklulus',  'Apps\Pendaftar::getShowDataTidakLulus');

        $routes->post('insert',                 'Apps\Pendaftar::InsertData');
        $routes->post('update',                 'Apps\Pendaftar::UpdateData');
        $routes->post('delete',                 'Apps\Pendaftar::DeleteData');
    });
});
