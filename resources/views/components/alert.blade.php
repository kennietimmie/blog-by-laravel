 @if(session()->has('message'))
   <div
     class=" flex items-center justify-center fixed bottom-0 right-0 mb-4 mr-4 bg-black text-white overflow-hidden max-w-sm min-w-[24rem] max-h-8 min-h-[2rem] rounded-xl">
     {{ session()->get('message') }}</div>
 @endisset
