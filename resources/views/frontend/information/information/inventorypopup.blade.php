<img src="{{ asset('/image/equipment/com_itemsign.PNG') }}" class="img-clear">
    @if($aItem['info']['sox'] || count($aItem['blues']) >= 1)
    @php
        $color = $aItem['info']['sox'] ? '#f2e43d' : '#50cecd';
    @endphp
    <span style="color:{{ $color }};font-weight: bold;">
    @endif
        {{ $aItem['info']['WebName'] }}
        @if(($aItem['OptLevel'] + $aItem['nOptValue']) > 0)
            (+{{ $aItem['OptLevel'] + $aItem['nOptValue'] }})
        @endif

        @if($aItem['info']['sox'] || count($aItem['blues']) >= 1)
    </span>
@endif

@if($aItem['info']['Degree'] >= 1)
    @isset($aItem['info']['sox'])
        <br>
        @if($aItem['info']['sox'])
            <br>
            <span style="color:#f2e43d;font-weight: bold;">
                {{ $aItem['info']['sox'] }}
            </span>
        @endif
    @endisset
    <br>

    {{--    @if($aItem['info']['egy'])--}}
    {{--        <span style="color:#53EE92;font-weight: bold;">{{ $aItem['info']['egy'] }}</span>--}}
    {{--    @endif--}}

    <span style="color:#efdaa4;">
        {{ __('inventory.sort', ['type' => $aItem['info']['Type']]) }}
        <br>
        @isset($aItem['info']['Detail'])
        {{ __('inventory.mounting', ['detail' => $aItem['info']['Detail']]) }}
            <br>
        @endisset
        {{ __('inventory.degree', ['degree' => $aItem['info']['Degree']]) }}
    </span>
    <br>
    <br>

    @foreach($aItem['whitestats'] as $iKey => $sWhites)
        {{ $sWhites }} <br>
    @endforeach

    <br>

    @isset($aItem['info']['ReqLevel1'])
        {{ __('inventory.require', ['level' => $aItem['info']['ReqLevel1']]) }}
        <br>
    @endif
    @isset($aItem['info']['Sex'])
        {{ $aItem['info']['Sex'] }}
        <br>
    @endif

    <span style="color:#efdaa4;">
        {{ __('inventory.max-unit', ['max' => $aItem['MaxMagicOptCount']]) }}
    </span>
    <br>
    @if($aItem['blues'])
        <br>
        @foreach($aItem['blues'] as $iKey => $aBlues)
            <span style="color:{{ '#' . $aBlues['color'] }};font-weight: bold;">
                {{ $aBlues['name'] }}
            </span>
            <br>
        @endforeach
    @endif

    @if($aItem['nOptValue'] === null)
        {{ __('inventory.able-adv') }}
    @else
        <b>
            {{ __('inventory.adv-inuse', ['plus' => $aItem['nOptValue']]) }}
        </b>
    @endif
    <br>
@elseif ($aItem['info']['Degree'])
    <br>
    <br>
    <span style="color:#efdaa4;">
        {{ __('inventory.sort', ['type' => $aItem['info']['Type']]) }}
    </span>
    <br>
    <br>
    {{ $aItem['info']['Sex'] }}
    <br>
    <br>
    @isset($aItem['info']['timeEnd'])
        <span style="color:#efdaa4;font-weight:bold;">
            {{ __('inventory.awaken') }}
        </span>
        <br>
        {{ $aItem['info']['timeEnd'] }}
        <br>
    @else
        @isset($aItem['blues'])
            <span style="color:#efdaa4;">
                {{ __('inventory.max-unit', ['max' => $aItem['MaxMagicOptCount']]) }}
            </span>
            <br>
            <br>
            @foreach($aItem['blues'] as $iKey => $aBlues)
                <span style="color:{{ '#' . $aBlues['color'] }};font-weight: bold;">
                    {{ $aBlues['name'] }}
                </span>
                <br>
            @endforeach
        @endisset
    @endisset
{{--@elseif ($aItem['info']['PetType'])--}}
{{--    <br><br>--}}
{{--    <span style="color:#efdaa4;">Sort of item: Summon Scroll</span>--}}
{{--    <span style="color:#efdaa4;font-weight:bold;">Pet information</span>--}}
@endif
