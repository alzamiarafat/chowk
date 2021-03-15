<div class="card card-profile shadow" id="clientInfo">
    <div class="px-4">
      <div class="mt-5">
        <h3>{{ __('Customer Info') }}<span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        @include('partials.fields',['fields'=>[
            ['ftype'=>'input','name'=>"",'id'=>"client_name",'placeholder'=>"Customer name...",'required'=>true],
        ]])
      </div>
      <br />
      <br />
    </div>
</div>
<br/>
