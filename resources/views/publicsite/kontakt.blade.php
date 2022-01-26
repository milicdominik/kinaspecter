@extends('layouts.publicsite.master')

@section('headertitle','Multiplex Cinestar Specter')
@section('headerp','Kontakt')
@section('Kontakt','active')

@section('content')
  <div class="content-area group section">
			<div class="container">
        <div class="d-flex justify-content-center">
          <img class="logo" src="slike/Logo.png" class="Logo">
        </div>
        <form class="needs-validation" novalidate>
            <div class="form-row">
              <div class="col-md-4 mb-3">
                <label for="validationCustom01">Ime</label>
                <input type="text" class="form-control" id="validationCustom01" placeholder="Ime" required>
                <div class="invalid-feedback">
                  Unesite Vaše ime!
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustom02">Prezime</label>
                <input type="text" class="form-control" id="validationCustom02" placeholder="Prezime" required>
                <div class="invalid-feedback">
                    Unesite Vaše prezime!
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustomEmail">Email adresa</label>
                  <input type="email" class="form-control" id="validationCustomEmail" placeholder="E-mail adresa" required>
                  <small id="emailHelp" class="form-text text-muted">Nikada ne dijelimo vašu e-mail adresu sa drugim stranama.</small>
                  <div class="invalid-feedback">
                    Unesite Vašu e-mail adresu!
                  </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom03">Grad</label>
                <input type="text" class="form-control" id="validationCustom03" placeholder="Grad" required>
                <div class="invalid-feedback">
                    Unesite Vaš grad!
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom04">Država</label>
                <input type="text" class="form-control" id="validationCustom04" placeholder="Država" required>
                <div class="invalid-feedback">
                  Unesite valjanu državu!
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom05">Poštanski broj</label>
                <input type="text" class="form-control" id="validationCustom05" placeholder="Poštanski kod" required>
                <div class="invalid-feedback">
                    Unesite valjani poštanski broj!
                </div>
              </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom06">Naslov</label>
                    <input type="text" class="form-control" id="validationCustom06" placeholder="Naslov" required>
                    <div class="invalid-feedback">
                        Molimo unesite naslov!
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-3">
                    <label for="validationCustom07">Opis</label>
                    <textarea class="form-control" id="validationCustom06" rows= "4" placeholder="Opis" required></textarea>
                    <div class="invalid-feedback">
                        Molimo unesite opis!
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Pošalji</button>
          </form>

        <script>
          (function() {
            'use strict';
            window.addEventListener('load', function() {
              var forms = document.getElementsByClassName('needs-validation');
              var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                  if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  else
                  {
                    //napravit ajax request sa podacima i spremit u bazu ili poslati email
                    new bootstrap.Modal(document.getElementById('kontakt')).show()
                    event.preventDefault();
                    event.stopPropagation();
                  }
                  form.classList.add('was-validated');
                }, false);
              });
            }, false);
          })();
          </script>

          <div class="modal fade" id="kontakt" tabindex="-1" aria-labelledby="kontaktLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 Poruka je uspješno poslana.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
@endsection
