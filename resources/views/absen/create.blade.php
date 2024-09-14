@extends('layouts.main')
@section('container')
<link rel="stylesheet" href="js/leaflet-search/dist/leaflet-search.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

   <script src="js/Control.Geocoder.js"></script>
   <script src="js/leaflet-search/dist/leaflet-search.src.js"></script>
   <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4 mt-4">
      @if(session()->has('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
    @endif

      <div class="row">
        <div class="col-xl-8 col-md-6">
          <div class="card bg-light text-white mb-8">
            <div class="card-body">
                <div id='map' style='width: 100%; height: 63vh; position: relative; '>
                    <script>
                      
                      @foreach($location as $l)  
                        let latLng=[{{ $l->latitude }},{{ $l->longitude }}];
                        // let latLng=[-1.3490088,100.5765809];
                        var map = L.map('map').setView(latLng, 15);
                        let centerMap=false;
                        var Layer =L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                            maxZoom: 20,
                            subdomains:['mt0','mt1','mt2','mt3']
                        });
                        @endforeach
                        map.addLayer(Layer);
                        getLocation();
                        setInterval(() => {
                        getLocation();
                        }, 5000);
                            function getLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition);
                            } else {
                                x.innerHTML = "Geolocation is not supported by this browser.";
                            }
                            }
                            // cicle
                            @foreach($location as $l)  
                            var circle = L.circle([{{ $l->latitude }},{{ $l->longitude }}], {
                            color: 'blue',
                            fillColor: 'blue',
                            fillOpacity: 0.5,
                            radius: 100
                            }).addTo(map);
                            @endforeach

                            function showPosition(position) {
                            console.log('Router sekarang',position.coords.latitude,position.coords.longitude)
                            $("[name=latitude]").val(position.coords.latitude);
                            $("[name=longitude]").val(position.coords.longitude);
                            let latLng=[position.coords.latitude,position.coords.longitude];
                            control.spliceWaypoints(0, 1, latLng);
                            if(centerMap==false){
                            map.panTo(latLng);
                            centerMap =true;
                              }
                            }

                           
                        var control= L.Routing.control({
                            waypoints: [
                            latLng
                            ], 
                            routeWhileDragging: true
                        })
                        control.addTo(map);
                    </script>

            </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6">
          <div class="card bg-light text-white mb-8">
            <div class="card-body">
              @php
              $waktu = date('H:i');
              @endphp
              {{-- @if($waktu >  11.00 && $waktu <= 11.20 ) --}}
              @if($waktu >  $absen_masuk->awal && $waktu <= $absen_masuk->akhir )
                <form method="POST" action="/absen/">
                  @csrf
                  <div class="form-group mb-3">
                    <label for="lat" class="text-dark">Nomor Induk Pegawai </label>
                    <input  id="lat" type="text" name="nama" class="form-control"  value="{{ auth()->user()->nik }}" readonly> 
                  </div>
                    <div class="form-group mb-3">
                      <label for="lat" class="text-dark">nama</label>
                      <input  id="lat" type="text" name="nama" class="form-control"  value="{{ auth()->user()->nama }}" readonly> 
                      <input  id="lat" type="hidden" name="user_id" class="form-control"  value="{{ auth()->user()->id }}" > 
                    </div>
                    
                    <div class="form-group mb-3">
                      <input  id="lat" type="hidden" name="latitude" class="form-control"  aria-describedby="emailHelp" readonly> 
                      {{-- <label for="log" class="hidden-dark">Logitude</label> --}}
                      <input id="lng" type="hidden" name="longitude" class="form-control" readonly>
                    </div>
                  
                    <div class="form-group mb-3">
                      <label for="exampleInputPassword1" class="text-dark">Tangal dan Waktu Absen</label>
                      <input id="lng" type="text" class="form-control" id="exampleInputPassword1" value="{{ date('d F Y h:i:s A')}}" readonly>
                      @error('tanggal')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- @if($absen->tanggal == date('d')) --}}
                    {{-- @if($absen !== 'null') --}}
                    {{-- <div class="mt-4 mb-0">
                      <div class="d-grid">
                          <button type="submit" class="btn btn-primary" disabled > Ambil Absen Masuk</button>
                      </div>
                    </div> --}}
                   
                    {{-- @if(session()->has('success')) --}}
                    @if(session()->get('ada'))
                    {{-- @if($absen->tanggal == date('d')) --}}
                    <div class="mt-4 mb-0">
                      <div class="d-grid">
                          <button type="submit" class="btn btn-primary" disabled > Ambil Absen Masuk</button>
                      </div>
                    </div>
                    @else
                    <div class="mt-4 mb-0">
                      <div class="d-grid">
                        <input type="hidden" name="absen_masuk" value="{{ date('h:i:s') }}">
                        <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                          <button type="submit" class="btn btn-primary" > Ambil Absen Masuk</button>
                      </div>
                    </div>
                    @endif
                  </form>
                  @elseif($waktu >  $absen_pulang->awal && $waktu <= $absen_pulang->akhir )
                  <form method="post" action="/absen/edit/{{ auth()->user()->id }}">
                    @method('put')
                    @csrf
                    <div class="form-group mb-3">
                      <label for="lat" class="text-dark">Nomor Induk Pegawai </label>
                      <input  id="lat" type="text" name="nama" class="form-control"  value="{{ auth()->user()->nik }}" readonly> 
                    </div>
                    <div class="form-group mb-3">
                      <label for="lat" class="text-dark">nama</label>
                      <input  id="lat" type="text"  class="form-control"  value="{{ auth()->user()->nama }}" readonly> 
                      <input  id="lat" type="hidden"  class="form-control"  value="{{ auth()->user()->id }}" > 
                    </div>
                    {{-- <div class="form-group mb-3">
                      <label for="lat" class="text-dark">Latitude</label>
                    </div>
                    <div class="form-group mb-3"> --}}
                      <input  id="lat" type="hidden" name="latitude" class="form-control"  aria-describedby="emailHelp" readonly> 
                      <input id="lng" type="hidden" name="longitude" class="form-control" readonly>
                      {{-- <label for="log" class="text-dark">Logitude</label>
                    </div> --}}
                    <div class="form-group mb-3">
                      <label for="exampleInputPassword1" class="text-dark">Tangal dan Waktu Absen</label>
                      <input id="lng" type="text" class="form-control" id="exampleInputPassword1" value="{{ date('d F Y h:i:s A') }}" readonly>
                    </div>
                    @if(session()->get('edit'))
                  <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <button type="btn" class="btn btn-primary" disabled > Ambil Absen Masuk</button>
                    </div>
                  </div>
                    @else
                  <div class="mt-4 mb-0">
                    <div class="d-grid">
                      <input type="hidden" name="absen_pulang" value="{{ date('h:i:s') }}">
                        <button type="submit" class="btn btn-primary" >Ambil Absen Pulang</button>
                    </div>
                  </div>
                  @endif
                  @else
                  <div class="form-group mb-3">
                    <label for="lat" class="text-dark">Nomor Induk Pegawai </label>
                    <input  id="lat" type="text" name="nama" class="form-control"  value="{{ auth()->user()->nik }}" readonly> 
                  </div>
                  <div class="form-group mb-3">
                    <label for="lat" class="text-dark">nama</label>
                    <input  id="lat" type="text"  class="form-control"  value="{{ auth()->user()->nama }}" readonly> 
                    <input  id="lat" type="hidden"  class="form-control"  value="{{ auth()->user()->id }}" > 
                  </div>
                  <input  id="lat" type="hidden" name="latitude" class="form-control"  aria-describedby="emailHelp" readonly> 
                  <input id="lng" type="hidden" name="longitude" class="form-control" readonly>
                {{-- </div>
                <div class="form-group mb-3">
                  <label for="lat" class="text-dark">Latitude</label>
                  <div class="form-group mb-3">
                    <label for="log" class="text-dark">Logitude</label>
                  </div> --}}
                  <div class="form-group mb-3">
                    <label for="exampleInputPassword1" class="text-dark">Tangal dan Waktu Absen</label>
                    <input id="lng" type="text" class="form-control" id="exampleInputPassword1" value="{{ date('d F Y h:i:s A')  }}" readonly>
                  </div>
                  <div class="mt-4 mb-0">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" disabled >Ambil Absen</button>
                    </div>
                  </div>
                  @endif
                  {{-- </form> --}}
            </div>
          </div>
        </div>
      </div>
     
      
    </div>
  </main>
@endsection