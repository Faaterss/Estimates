<x-app-layout :aimx="$aimx">

    <div class="container" id="profile-overview">

        @include($aimx['module']. '::'. $aimx['code']. '_profile_header', ['aimx' => $aimx, 'tab' => $tab])
        
        <div id="profile-content">
            @include($aimx['module']. '::'. $aimx['code']. '_profile_'.$tab , ['aimx' => $aimx, 'tab' => $tab])
        </div>
        
    </div>

</x-app-layout>
