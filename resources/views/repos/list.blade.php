<div class="panel panel-default">
    <div class="panel-heading text-center">
        <h4>Your repositories</h4>
    </div>
    <div class="panel-body">
        @forelse ($repos as $repo)
            <a href="/repos/{{$repo['name']}}" style="text-decoration: none">
                <h4>
                    {{ $repo['name']}}
                    @if($repo['open_issues_count'] > 0)
                        <span class="badge">
                            {{$repo['open_issues_count']}}
                        </span>
                    @endif
                </h4>
            </a>
        @empty
            <h5>No repositories found</h5>
        @endforelse
    </div>
</div>