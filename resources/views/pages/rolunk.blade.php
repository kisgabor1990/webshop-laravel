@extends('index')

@section('content')

    <h2>A {{ env('APP_NAME') }} köszönti Önt weboldalán!</h2>

    <p>Üzletünkben új, külföldről importált gépekkel találkozhat, melyekhez olcsón, jóval a piaci ár alatt juthat hozzá. 15 éves szakmai tapasztalatunknak köszönhetően válogatjuk ki vásárlóink számára a legjobb minőségű készülékeket. A külföldről importált termékeinket szigorú audit folyamatok alá vetjük, majd újracsomagolva, a hatályos jogszabályok szerinti garanciával értékesítjük. Termékeink műszakilag kifogástalan állapotban, 1 vagy 2 év jótállással kerülnek újra értékesítésre.</p>

    <p>Készülékeinkhez nem minden esetben tudunk gyári csomagolást és magyar nyelvű használati utasítást biztosítani!</p>

    <p>A {{ env('APP_NAME') }} széles kinálatának köszönhetően biztosíthatjuk, hogy Ön is megtalálhassa a számára legmegfelelőbb termékeket árban, minőségben és szolgáltatásban egyaránt. Kínálatunkat folyamatosan bővítjük és frissítjük, minden erőnkkel azon vagyunk, hogy az aktuális trendet követve beszerezzük a lehető legjobb minőségű Outlet termékeket.</p>

    <p>Telefonos Ügyfélszolgálat: A {{ env('APP_NAME') }} munkatársaival online ügyfélszolgálatunkon keresztül ({{ env('STORE_EMAIL') }}) vagy telefonon is kommunikálhat, így kérdése, problémája mindíg visszakövethető, mely nagyban segíti az Ön és Weboldalunk kommunikációját. Munkatársaink minden esetben 12 órán belül reagálnak problémájára, vagy kérdésére. Ha termékkel kapcsolatos kérdése van, hivjon vagy írjon nekünk.</p>
@endsection
