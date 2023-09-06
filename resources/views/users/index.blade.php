@extends('layouts.app')

@section('content') 
  <div class="pt-5 pb-6 bg-cover" style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>

  <div class="container my-3 py-3">
    <div class="row mt-n6 mb-6">
      <div class="col-lg-3 col-sm-6">
        <div class="card blur border border-white mb-4 shadow-xs">
          <div class="card-body p-4">
            <div class="icon icon-shape bg-white shadow shadow-xs text-center border-radius-md d-flex align-items-center justify-content-center mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" height="19" width="19" viewBox="0 0 24 24" fill="currentColor">
                <path d="M11.584 2.376a.75.75 0 01.832 0l9 6a.75.75 0 11-.832 1.248L12 3.901 3.416 9.624a.75.75 0 01-.832-1.248l9-6z" />
                <path fill-rule="evenodd" d="M20.25 10.332v9.918H21a.75.75 0 010 1.5H3a.75.75 0 010-1.5h.75v-9.918a.75.75 0 01.634-.74A49.109 49.109 0 0112 9c2.59 0 5.134.202 7.616.592a.75.75 0 01.634.74zm-7.5 2.418a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75zm3-.75a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0v-6.75a.75.75 0 01.75-.75zM9 12.75a.75.75 0 00-1.5 0v6.75a.75.75 0 001.5 0v-6.75z" clip-rule="evenodd" />
                <path d="M12 7.875a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" />
              </svg>
            </div>
            <p class="text-sm mb-1">Today's Revenue</p>
            <h3 class="mb-0 font-weight-bold">$8,093.00</h3>
          </div>
        </div>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="d-flex align-items-center mb-4">
          <h3 class="mb-1 font-weight-bold">
            Wallet
          </h3>
        </div>
        <div class="d-md-flex align-items-center mb-4">
          <div class="mb-md-0 mb-3">
            <h5 class="font-weight-semibold mb-1">Billing and invoicing</h5>
            <p class="text-sm mb-0">Pick an account plan that fits your workflow.</p>
          </div>
          <button type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 ms-md-auto">
            <span class="btn-inner--icon">
              <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block me-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"></path>
              </svg>
            </span>
            <span class="btn-inner--text">Download</span>
          </button>
        </div>
      </div>
    </div> 
  </div>  
@endsection
