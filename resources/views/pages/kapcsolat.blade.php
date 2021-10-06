@extends('index')

@section('content')

    <h2>Üzletünk</h2>

    <p>{{ env('STORE_ADDRESS') }} {{ env('STORE_ADDRESS2') }}</p>
    <p>{{ env('STORE_ZIP') }} {{ env('STORE_CITY') }}</p>
    <p>{{ env('STORE_PHONE') }}</p>

    <h4>Bolt nyitvatartása</h4>

    <div class="col-sm-12 col-lg-4">
        <table class="table">
            <tr>
                <td class="text-end">Hétfő</td>
                <td>09-18h -ig</td>
            </tr>
            <tr>
                <td class="text-end">Kedd</td>
                <td>09-18h -ig</td>
            </tr>
            <tr>
                <td class="text-end">Szerda</td>
                <td>09-18h -ig</td>
            </tr>
            <tr>
                <td class="text-end">Csütörtök</td>
                <td>09-18h -ig</td>
            </tr>
            <tr>
                <td class="text-end">Péntek</td>
                <td>09-18h -ig</td>
            </tr>
            <tr>
                <td class="text-end">Szombat</td>
                <td>09-12h -ig</td>
            </tr>
            <tr>
                <td class="text-end">Vasárnap</td>
                <td>Zárva</td>
            </tr>
        </table>
    </div>

@endsection
