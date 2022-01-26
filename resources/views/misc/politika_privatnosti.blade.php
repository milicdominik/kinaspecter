{{--
https://asistent.skolskaknjiga.hr/opci-uvjeti-privatnosti
--}}
@extends('layouts.page')
@section('breadchrumb')
<li class="breadcrumb-item active"><a href="{{route('politika_privatnosti')}}">Politika privatnosti</a></li>
@endsection
@section('content')
<div class="card mt-2">
  <div class="card-body">
    <h3 class="mb-4">Opći uvjeti privatnosti aplikacije "{{config('app.name')}}"</h3>
    <p>
      {{config('app.description')}} u nastavku "{{config('app.name')}}".
      Aplikacija omogućava da se postojeći procesi digitaliziraju i da se olakša administracija vezana uz planiranje, izvođenje i rezerviranje predstava
      <br />
    </p>
    <h4>Jamčimo sigurnost svih vaših podataka</h4>
    <p>
      {{config('gdpr.ustanova_duginaziv')}} (dalje u tekstu: {{config('gdpr.ustanova_kratkinaziv')}}) kao voditelj obrade u odnosu na podatke korisnika aplikacije "{{config('app.name')}}"
      obvezuje se pružati zaštitu osobnih podataka svojih korisnika (zaposlenici, posjetitljei te ostali) te s tim u vezi prikuplja samo nužne i osnovne podatke o korisnicima
      koji su strogo potrebni za pružanje usluge vezane uz korištenje aplikacije "{{config('app.name')}}", ali i za ispunjenje očekivanja vas kao našeg korisnika.
      <br />
      Našeg službenika za zaštitu osobnih podataka možete dobiti na {{config('gdpr.gdpr_email')}}
    </p>
    <h4>Podaci koje imamo o korisnicima aplikacije</h4>
    <p>
      Svi podaci o korisnicima se strogo čuvaju i dostupni su samo djelatnicima kojima su nužni za obavljanje posla iz njihove nadležnosti.
      Djelatnici {{config('gdpr.ustanova_kratkinaziv')}} i poslovni partneri odgovorni su za pridržavanje načela zaštite privatnosti.
      Uz sve navedeno, naglašavamo kako su djelatnici {{config('gdpr.ustanova_kratkinaziv')}} potpisali Izjave o povjerljivosti,
      dok je sa svim partnerima koji nam pomažu da ova aplikacija funkcionira na očekivani način potpisan Ugovor o obradi i dijeljenju podataka.
    </p>
    <p>
      O posjetitelju vodimo sljedeće osobne podatke: ime, prezime, OIB, email, datum i godinu rođenja te broj mobitela (osobni).
      <br />
      O zaposlenicima ustanove vodimo sljedeće osobne podatke: ime, prezime, OIB, email, datum i godinu rođenja te broj mobitela.
    </p>
    <h4>Korištenje aplikacije</h4>
    <h5 class="mt-4">Pristup aplikaciji</h5>
    <p>
    Aplikaciji imaju pristup posjetitelji i djelatnici putem svojih korisničkih podataka. Nikakve informacije nisu dostupne posjetiocima ove
    web aplikacije bez korisničkih podataka.
    </p>

    <h5 class="mt-4">Tko vidi osobne podatke drugih korisnika</h5>
    <p>
      Posjetitelj vidi samo svoje osobne podatke. Voditelj vidi osobne podatke svih posjetitelja i djelatnika.
      Svi (bez obzira je li posjetitelj ili djelatnik) vide uvijek ime, prezime.
    </p>

    <h4>Politika kolačića (cookies)</h4>
    <p>Korisnik aplikacije "{{config('app.name')}}" odmah se nakon pristupanja aplikaciji upoznaje sa pravilima privatnosti u sklopu ovih uvjeta i korištenjem kolačića.
      Aplikacija "{{config('app.name')}}" koristi se kolačićima kako bi osigurala pravilno funkcioniranje aplikacije te poboljšala iskustvo korisnika.</p>

    <p>Kolačići su malene datoteke koje se spremaju na računalo dok pristupate web-stranicama ili aplikacijama,
    obično se to događa kada prvi put posjetite neku web-stranicu ili kada skinete aplikaciju.
    Korištenjem kolačića omogućava se pamćenje vaših postavki te se osigurava da aplikaciju koristite na siguran način.</p>

    <p>{{config('app.name')}} ne koristi kolačiće koji vam mogu naštetiti. Kolačići ne mogu nositi viruse, oni omogućuju da kao korisnik imate bolje iskustvo pri korištenju aplikacije.</p>

    <p>Upotrebom kolačića (cookies) podaci za držanje otvorene korisničke sesije, pružanje boljega korisničkog iskustva, funkcionalnost usluga.</p>

    <h5 class="mt-4">Kakve kolačiće upotrebljava aplikacija?</h5>
    <ul>
      <li>
        Privremene kolačiće – kolačići koji će se automatski izbrisati pri zatvaranju internetskog preglednika u kojem radite.
      </li>
      <li>
        Stalne kolačiće – kolačići koji će ostati "zabilježeni" u vašemu internetskom pregledniku dok ne isteknu ili ih sami ručno ne izbrišete ukoliko ste označili opciju "Zapamti me" pri prijavi.
      </li>
    </ul>

    <h5 class="mt-4">Završne odredbe i kontakt</h5>
    <p>
      Sastavni dio cjelokupne Politike privatnosti {{config('app.name')}} uz ove uvjete čine i drugi opći akti ustanove: {{config('gdpr.ustanova_duginaziv')}}.
      @if(config('gdpr.ostaliakti_url'))
      <br />Molimo dodatne informacije o privatnosti  potražite na službenim stranicama: <a href="{{config('gdpr.ostaliakti_url')}}" target="_blank">{{config('gdpr.ostaliakti_url')}}</a>
    @endif
    </p>

    <div>
      Zadnja izmjena: {{config('gdpr.updated_date_text')}}
    </div>

  </div>
</div>
@endsection
