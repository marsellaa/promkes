@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('About') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}"  alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">E-Promkes</h5>
                            <p>E-Promkes : Elektronik Promosi Kesehatan</p>
                            <p>Aplikasi berbasis web yang digunakan untuk pencatatan kegiatan yang dilaksanakan pada Rumah Sakit Mohammad Hoesin (RSMH)</p>
                            
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Credits</h5>
                            <p>Merupakan hasil dari kerja sama pihak RSMH dan Universitas Multi Data Palembang.</p>
                            <ul>
                                <li><a href="https://mdp.ac.id" target="_blank">MDP</a> - Universitas Multi Data Palembang.</li>
                                <li><a href="https://www.rsmh.co.id" target="_blank">RSMH</a> - Rumah Sakit Mohammad Hoesin Palembang.</li>
                                <li><a href="https://instagram.com/mar.selak" target="_blank">Marsella</a> - Terima Kasih atas kesempatannya.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
