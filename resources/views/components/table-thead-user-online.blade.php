<thead>
    <tr>
        {{ $slot }}
        @foreach ($columns as $column=>$columnName)
            @if( in_array($column,['uptime','city']))
                <th wire:click="orderBy('{{ $column }}')">
                    <span class="badge">{{$columnName}}</span>
                    <i class="fa fa-long-arrow-down text-primary"></i>
                </th>
            @else
                <th>
                    <span class="badge">{{$columnName}}</span>
                </th>
            @endif
        @endforeach
    </tr>
</thead>
