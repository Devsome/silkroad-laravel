@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            createMinimapCanvas(
                '{{ asset('image/worldmap/8') }}/',
                'player-map',
                150,
                150,
                {{ $player->PosX }},
                {{ $player->PosY }},
                {{ $player->PosZ }},
                {{ $player->LatestRegion }}
            );
        });
    </script>
@endpush
