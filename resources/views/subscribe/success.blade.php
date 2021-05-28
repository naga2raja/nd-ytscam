<x-app-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Subscription') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Subscribe Success') }}</li>
          </ol>
        </nav>
    </x-slot>

    <div class="col-md-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <a href="{{ route('dashboard') }}" class="btn btn-success pull-right"> <i class="fa fa-arrow-left"></i> Go Back</a> <br> 
                <div style="clear: both;"></div>

                <div class="alert alert-success mt-5">
                     <b>Subscribed Successfully!!</b>
                </div>
            </div>           
        </div>
    </div>
    
</x-app-layout>
