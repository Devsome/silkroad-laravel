@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            createMinimapCanvas(
                '{{ asset('image/worldmap/8') }}/',
                'player-map',
                206,
                206,
                {{ $player->PosX }},
                {{ $player->PosZ }},
                {{ $player->PosY }},
                {{ $player->LatestRegion }}
            );
            addMinimapCursor(
                'player-map',
                '{{ asset('image/worldmap/icon/mm_sign_otherplayer.png') }}',
                6,
                6
            );
        });
    </script>
@endpush
