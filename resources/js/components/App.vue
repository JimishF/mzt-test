<template>
  <div class="min-h-[100%] bg-[#FAF6F0] bg-opacity-100">
    <div>
      <div class="w-full bg-[#1E3D44] p-6 text-right text-white font-bold">My wallet
        <svg class="inline-block mx-2" height="25" width="25" version="1.1" xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink"
             x="0px" y="0px" viewBox="0 0 44 44" style="enable-background:new 0 0 44 44;" xml:space="preserve">
            <g>
                <path style="fill:#F0C419;"
                      d="M22,44C9.869,44,0,34.131,0,22S9.869,0,22,0s22,9.869,22,22S34.131,44,22,44z"/>
              <path style="fill:#FBD490;" d="M22.745,32h-1.491C20.009,32,19,30.991,19,29.745V13.255C19,12.009,20.009,11,21.255,11h1.491
                    C23.991,11,25,12.009,25,13.255v16.491C25,30.991,23.991,32,22.745,32z"/>
              <path style="fill:#F0C419;"
                    d="M22,44C9.869,44,0,34.131,0,22S9.869,0,22,0s22,9.869,22,22S34.131,44,22,44z"/>
              <path style="fill:#FBD490;" d="M22.745,32h-1.491C20.009,32,19,30.991,19,29.745V13.255C19,12.009,20.009,11,21.255,11h1.491
                    C23.991,11,25,12.009,25,13.255v16.491C25,30.991,23.991,32,22.745,32z"/>
            </g>
        </svg>
        0 Coins
      </div>
      <div class="container my-12 px-6 mx-auto">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
<script>
  export default {}
</script>