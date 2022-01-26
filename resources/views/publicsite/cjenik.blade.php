@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Cjenik')
@section('Cjenik','active')

@section('content')
  <div class="content-area group section">
			    <div class="container">
                    <div class="main-area">
                        <h2 class="mb-3">Cjenik</h2>
                        <p>U svim gradovima vrijede identične cijene za ulaznice.</p>

                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>Dani</th>
                                <th>Regular seat</th>
                                <th>VIP seat</th>
                                <th>Love seat</th>
                                <th>Happy hour(14h-17h)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th>Ponedjeljak</th>
                                <td>25 kn</td>
                                <td>50 kn</td>
                                <td>45 kn</td>
                                <td>-20% na sve ulaznice</td>
                              </tr>
                              <tr>
                                <th>Utorak</th>
                                <td>25 kn</td>
                                <td>50 kn</td>
                                <td>45 kn</td>
                                <td>-20% na sve ulaznice</td>
                              </tr>
                              <tr>
                                <th>Srijeda</th>
                                <td>25 kn</td>
                                <td>50 kn</td>
                                <td>45 kn</td>
                                <td>-20% na sve ulaznice</td>
                              </tr>
                              <tr>
                                <th>Četvrtak</th>
                                <td>25 kn</td>
                                <td>50 kn</td>
                                <td>45 kn</td>
                                <td>-20% na sve ulaznice</td>
                              </tr>
                              <tr>
                                <th>Petak</th>
                                <td>25 kn</td>
                                <td>50 kn</td>
                                <td>45 kn</td>
                                <td>-20% na sve ulaznice</td>
                              </tr>
                              <tr>
                                <th>Subota</th>
                                <td>30 kn</td>
                                <td>55 kn</td>
                                <td>50 kn</td>
                                <td></td>
                              </tr>
                              <tr>
                                <th>Nedjelja</th>
                                <td>30 kn</td>
                                <td>55 kn</td>
                                <td>50 kn</td>
                                <td>-10% na sve ulaznice</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                <div class="d-flex justify-content-center">
                  <img class="logo" src="slike/Logo.png" class="Logo">
                </div>
            </div> 
        </div>
@endsection
