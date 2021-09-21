@extends('admin.index')

@section('content')


    <div class="row">
        <div class="col-12 col-lg-10">
            <div class="row justify-content-center mb-5">
                <div class="col-auto me-sm-auto">
                    <p class="h1 user-select-none">
                        <i class="fas fa-clipboard-list"></i> Rendelések
                    </p>
                </div>
            </div>


            <div class="table-responsive">
                <p class="h4 user-select-none text-center mb-3">Új megrendelések</p>
                <table class="table table-striped table-hover @if (count($orders->where('status', 'Új megrendelés'))) list @endif">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>Azonosító</th>
                            <th>Megrendelés dátuma</th>
                            <th>Státusz</th>
                            <th>Fizetési mód</th>
                            <th>Fizetve</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders->where('status', 'Új megrendelés') as $order)
                            <tr class="align-middle">
                                <td class="text-nowrap fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="text-nowrap">{{ $order->created_at }}</td>
                                <td class="text-nowrap">{{ $order->status }}</td>
                                <td class="text-nowrap">{{ $order->payment }}</td>
                                <td class="text-nowrap">{{ $order->isPaid ? "Igen" : "Nem" }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('admin/rendelesek/mutat/' . $order->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ url('admin/rendelesek/szerkeszt/' . $order->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm delete" href="#"
                                           data-href="{{ url('admin/rendelesek/torol/' . $order->id) }}"
                                           data-header="rendelés" data-id="#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}"
                                           data-name="{{ $order->customer->name }}" role="button"
                                           data-bs-tooltip="tooltip" data-placement="top" title="Törlés">
                                            <i class="fas fa-trash fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Jelenleg nincsenek új megrendelések!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <p class="h4 user-select-none text-center mt-5 mb-3">Folyamatban lévő megrendelések</p>
                <table class="table table-striped table-hover @if (count($orders->where('status', '!=', 'Új megrendelés')->where('status', '!=', 'Lezárt')->where('status', '!=', 'Törölt'))) list @endif">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>Azonosító</th>
                            <th>Megrendelés dátuma</th>
                            <th>Státusz</th>
                            <th>Fizetési mód</th>
                            <th>Fizetve</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders->where('status', '!=', 'Új megrendelés')->where('status', '!=', 'Lezárt')->where('status', '!=', 'Törölt') as $order)
                            <tr class="align-middle">
                                <td class="text-nowrap fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="text-nowrap">{{ $order->created_at }}</td>
                                <td class="text-nowrap">{{ $order->status }}</td>
                                <td class="text-nowrap">{{ $order->payment }}</td>
                                <td class="text-nowrap">{{ $order->isPaid ? "Igen" : "Nem" }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('admin/rendelesek/mutat/' . $order->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ url('admin/rendelesek/szerkeszt/' . $order->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Szerkesztés">
                                            <i class="fas fa-edit fa-sm fa-fw"></i>
                                        </a>
                                        @if ($order->status != "Futárnak átadva")
                                        <a class="btn btn-danger btn-sm delete" href="#"
                                            data-href="{{ url('admin/rendelesek/torol/' . $order->id) }}"
                                            data-header="rendelés" data-id="#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}"
                                            data-name="{{ $order->customer->name }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Törlés">
                                            <i class="fas fa-trash fa-sm fa-fw"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Jelenleg nincsenek folyamatban lévő megrendelések!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <p class="h4 user-select-none text-center mt-5 mb-3">Lezárt megrendelések</p>
                <table class="table table-striped table-hover @if (count($orders->where('status', 'Lezárt'))) list @endif">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>Azonosító</th>
                            <th>Megrendelés dátuma</th>
                            <th>Státusz</th>
                            <th>Fizetési mód</th>
                            <th>Fizetve</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders->where('status', 'Lezárt') as $order)
                            <tr class="align-middle">
                                <td class="text-nowrap fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="text-nowrap">{{ $order->created_at }}</td>
                                <td class="text-nowrap">{{ $order->status }}</td>
                                <td class="text-nowrap">{{ $order->payment }}</td>
                                <td class="text-nowrap">{{ $order->isPaid ? "Igen" : "Nem" }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('admin/rendelesek/mutat/' . $order->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Jelenleg nincsenek lezárt megrendelések!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="table-responsive">
                <p class="h4 user-select-none text-center mt-5 mb-3">Törölt megrendelések</p>
                <table class="table table-striped table-hover @if (count($orders->where('status', 'Törölt'))) list @endif">
                    <thead class="thead-inverse user-select-none">
                        <tr>
                            <th>Azonosító</th>
                            <th>Megrendelés dátuma</th>
                            <th>Státusz</th>
                            <th>Fizetési mód</th>
                            <th>Fizetve</th>
                            <th class="text-end">Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders->where('status', 'Törölt') as $order)
                            <tr class="align-middle">
                                <td class="text-nowrap fw-bold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="text-nowrap">{{ $order->created_at }}</td>
                                <td class="text-nowrap">{{ $order->status }}</td>
                                <td class="text-nowrap">{{ $order->payment }}</td>
                                <td class="text-nowrap">{{ $order->isPaid ? "Igen" : "Nem" }}</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ url('admin/rendelesek/mutat/' . $order->id) }}" role="button"
                                            data-bs-tooltip="tooltip" data-placement="top" title="Megtekintés">
                                            <i class="fas fa-eye fa-sm fa-fw"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Jelenleg nincsenek törölt megrendelések!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
