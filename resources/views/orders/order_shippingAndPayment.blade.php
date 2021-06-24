@extends('index')

@section('content')

    <h1 class="user-select-none mb-5 text-center">Fizetés és szállítás</h1>

    <div class="position-relative m-4 user-select-none">
        <div class="progress" style="height: 30px;">
            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <a href="{{ url('megrendeles/adatok') }}"
            class="position-absolute top-50 translate-middle py-0 btn btn-outline-primary circle border border-primary border-5 rounded-circle"
            style="left: 25%;">1</a>
        <span
            class="position-absolute top-50 translate-middle circle text-primary border border-primary border-5 rounded-circle"
            style="left: 50%;">2</span>
        <span
            class="position-absolute top-50 translate-middle circle text-secondary border border-200 border-5 rounded-circle"
            style="left: 75%;">3</span>
        <span
            class="position-absolute top-50 translate-middle circle text-secondary border border-200 border-5 rounded-circle"
            style="left: 100%;">4</span>
    </div>
    <div class="position-relative m-4 d-none d-lg-block">
        <span class="position-absolute top-50 translate-middle" style="left: 25%;">Adatok megadása</span>
        <span class="position-absolute top-50 translate-middle" style="left: 50%;">Fizetés és szállítás</span>
        <span class="position-absolute top-50 translate-middle" style="left: 75%;">Adatok ellenőrzése</span>
        <span class="position-absolute top-50 translate-middle text-nowrap" style="left: 100%;">Megrendelés elküldése</span>
    </div>
    <form class="needs-validation" action="{{ url('/megrendeles/fizetes-es-szallitas') }}" method="post" novalidate>
        @csrf
        <div class="card mb-5" style="margin-top: 6rem;">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Fizetési mód
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="simplepay" value="SimplePay" disabled>
                        <label class="form-check-label" for="simplepay">
                          <p class="fw-bold mb-0">Bankkártyás fizetés a Simple rendszerén keresztül (fejlesztés alatt)</p>
                          <p class="mt-0">Bankkártyás vásárlás esetén az OTP Simple pénzügyi szolgáltató titkosított biztonságos fizetőoldalára irányítjuk át a megrendelés után. Webáruházunk csak a tranzakció sikerességéről kap értesítést, nem férhetünk hozzá semmilyen körülmények között a bankkártya adataihoz. Bármely Magyarországon és külföldön kibocsájtott bankkártyával és hitelkártyával lehet nálunk fizetni.</p>
                        </label>
                    </div>
                    <div class="form-check">  {{-- c_o_d = cash on delivery --}}
                        <input class="form-check-input" type="radio" name="payment" id="c_o_d" value="Utánvét"
                        @if (session('customer.payment') == 'Utánvét' || old('payment') == 'Utánvét') checked @endif>  
                        <label class="form-check-label" for="c_o_d">
                          <p class="fw-bold mb-0">Utánvét</p>
                          <p class="mt-0">Utánvéttel történő fizetés esetén készpénzben vagy bankkártyával lehet fizetni a futárnak vagy üzletünkben szállítási módtól függően.</p>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="transfer" value="Átutalás"
                        @if (session('customer.payment') == 'Átutalás' || old('payment') == 'Átutalás') checked @endif>
                        <label class="form-check-label" for="transfer">
                          <p class="fw-bold mb-0">Előre utalás</p>
                          <p class="mt-0">A vásárlás értékét az XY Banknál vezetett folyószámlánkra tudja átutalni.<br>
                                            <span class="fw-bold">Számlaszám:</span> 11223344-55667788 <span class="fw-bold">Név:</span> XYZ Kft.<br>
                                            A közleménybe feltétlenül írja bele a <span class="fw-bold">megrendelés számát</span>.</p>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-header text-center text-uppercase bg-dark text-white">
                Szállítási mód
            </div>
            <div class="card-body py-5">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping" id="courier" value="XY Futárszolgálat|1490"
                        @if (session('customer.shipping_mode') == 'XY Futárszolgálat' || old('shipping') == 'XY Futárszolgálat|1490') checked @endif>
                        <label class="form-check-label w-100" for="courier">
                            <div class="row align-items-center">
                                <div class="col-12 col-lg-10">
                                    <p class="fw-bold mb-0">XY futárszolgálat házhoz szállítással</p>
                                    <p class="mt-0">Csomagját XY Futárszolgálattal fogjuk küldeni. Az XY a magyar és európai piac meghatározó csomaglogisztikai szolgáltatójaként minőségi, gyors és rugalmas kézbesítést garantál. Amennyiben utánvétes a küldemény, akkor azt a kézbesítőnek kell készpénzben vagy bankkártyával fizetni. A szállítás a mi felelősségünk, ha nem érkezik meg a küldemény, újraküldjük vagy visszafizetjük az árát.</p>
                                </div>
                                <div class="col-12 col-lg-2 text-start text-lg-end">
                                    <p class="mt-0">1 490 Ft.</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping" id="personal" value="Személyes átvétel|0"
                        @if (session('customer.shipping_mode') == 'Személyes átvétel' || old('shipping') == 'Személyes átvétel|0') checked @endif>
                        <label class="form-check-label w-100" for="personal">
                          <div class="row align-items-center">
                              <div class="col-12 col-lg-10">
                                  <p class="fw-bold mb-0">Személyes átvétel üzletünkben</p>
                                  <p class="mt-0">Csomagját összekészítés után személyesen tudja átvenni üzletünkben.<br>
                                                    Cím: 6000 Kecskemét, XY utca 1<br>
                                                    Nyitvatartás: H-P: 8-16 Szo: 8-12</p>
                              </div>
                              <div class="col-12 col-lg-2 text-start text-lg-end">
                                  <p class="mt-0">Ingyenes!</p>
                              </div>
                          </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 mb-5 d-flex justify-content-between">
            <a href="{{ url('/megrendeles/adatok') }}" class="btn btn-secondary">Vissza</a>
            <button type="submit" class="btn btn-dark">Tovább</button>
        </div>
    </form>

@endsection
