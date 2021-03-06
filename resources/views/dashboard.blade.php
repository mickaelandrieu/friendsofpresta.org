@extends('layouts.app')

@section('title', "Dashboard")

@section('content')
    <div class="container-fluid p-1 px-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>

        <h1 class="mb-2">Dashboard</h1>

        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card h-100">
                    <div class="card-header">Inscriptions #ecommercesolidaire</div>
                    <div class="card-body">
                        <div class="d-flex h-100 align-items-center justify-content-center">
                            <div class="display-2 text-center mr-2">{{ array_sum($inscription) }}</div>
                            <div>
                                <div>En attente : <strong>@can('viewAny', \App\Models\Inscription::class) <a href="{{ route('admin.inscriptions') . '?status=A+attribuer' }}"> @endcan {{ array_key_exists('A attribuer', $inscription) ? $inscription['A attribuer'] : '0' }} @can('viewAny', \App\Models\Inscription::class) </a> @endcan</strong></div>
                                <div>En cours : <strong><a href="{{ route('admin.inscriptions') . '?status=création+en+cours' }}">{{ array_key_exists('création en cours', $inscription) ? $inscription['création en cours'] : '0' }}</a></strong></div>
                                <div>En ligne : <strong><a href="{{ route('admin.inscriptions') . '?status=en+ligne' }}">{{ array_key_exists('en ligne', $inscription) ? $inscription['en ligne'] : '0' }}</a></strong></div>
                            </div>
                        </div>
                    </div>
                    @can('viewAny', \App\Models\Inscription::class)
                        <div class="card-footer"><a href="{{ route('admin.inscriptions') }}" class="card-link">Listing des inscriptions</a></div>
                    @endcan
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">Podium #ecommercesolidaire</div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>En cours</th>
                                            <th>En ligne</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                @foreach($top as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->inprogress }}</td>
                                        <td>{{ $user->online }}</td>
                                        <td>{{ $user->total }}</td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"><a href="{{ route('admin.inscriptions.stats') }}" class="card-link">Listing complet</a></div>
                </div>
            </div>

            @can('viewOrdersNumber', \App\Models\Inscription::class)
            <div class="col-md-4 mb-2">
                <div class="card h-100">
                    <div class="card-header">Total commandes #ecommercesolidaire</div>
                    <div class="card-body">
                        <div class="d-flex h-100 flex-column align-items-center justify-content-center">
                            <div class="display-2 text-center">{{ $orders['total'] }}</div>
                            @can('viewOrdersCA', \App\Models\Inscription::class)
                            <div class="display-4 text-center">{{ number_format($orders['ca'], 2, ',', ' ') }} €</div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">Utilisateurs</div>
                    <div class="card-body">
                        <div class="display-2 text-center">{{ $users['total'] }}</div>
                    </div>
                    @can('viewAny', \App\Models\Inscription::class)
                        <div class="card-footer">
                            <a href="{{ route('admin.users') }}" class="card-link">Listing des utilisateurs</a>
                            @can('create', \App\User::class)
                                <a href="{{ route('register') }}" class="btn btn-sm btn-primary float-right">Créer</a>
                            @endcan
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
