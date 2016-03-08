<div class="col-sm-4">
    <h4>
        {{$current_repo}}
    </h4>
</div>
{!! Form::open(['class'=>'form-inline col-sm-8', 'url'=>"repos/$current_repo", 'method'=>'GET']) !!}
<label class="col-sm-12">Filter By:</label>
<div class="form-group col-sm-4">
    {!! Form::select('member', [''=>'-Assignments-']+$members, old('members'), ['class'=>'form-control input-sm filter']) !!}
</div>
<div class="form-group col-sm-4">
    {!! Form::select('milestone', [''=>'-Milestones-']+$milestones, old('milestones'), ['class'=>'form-control input-sm filter']) !!}
</div>
<div class="form-group col-sm-4">
    {!! Form::select('label', [''=>'-Labels-']+$labels, old('labels'), ['class'=>'form-control input-sm filter']) !!}
</div>
<div class="form-group">
    <input type="hidden" name="filter">
    <input type="hidden" name="value">
</div>
{!! Form::close() !!}
<div class="col-sm-12">
    <hr style="margin-top: 2px; margin-bottom: 2px;">
</div>
<div class="clearfix"></div>
<div class="col-sm-12" data-collapse="accordion">
    @forelse($issues as $issue)
        <h5 class="col-sm-12">
           <span class="fa fa-exclamation-circle"></span> {{$issue['title']}}
        </h5>
        <div class="col-sm-12">
            <span class="small">Comments</span><br>
            @forelse($issue['all_comments'] as $comment)
                <div class="col-sm-12">
                    <b>
                        <h5 class="small" style="margin-top:2px; margin-bottom:2px"><span class="fa fa-user"></span> {{$comment['user']['login']}}</h5>
                    </b>
                    <blockquote class="small text-muted" style="padding:2px">
                       {{$comment['body']}}
                    </blockquote>
                </div>
                @empty
                    <div class="col-sm-12">
                        <h5>
                           No comments on this issue
                        </h5>
                    </div>
            @endforelse
            {!! Form::open(['class'=>'col-sm-4', 'url'=>"repos/{$current_repo}/issues/{$issue['number']}/comments"]) !!}
                <span class="small">Write Comment:</span>
            <div class="form-group">
                <textarea name="comment" required class="form-control input-sm"></textarea>
            </div>
            <div class="form-group">
                <input required placeholder="Github Password" type="password" name="git_password" class="form-control input-sm">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-sm btn-primary"><span class="fa fa-comment"></span> Add Comment</button>
            </div>
            <hr style="margin-top: 2px; margin-bottom: 2px;">
            {!! Form::close() !!}
        </div>
        @empty
        <div class="col-sm-12" data-collapse="open">
            <div class="col-sm-12"></div>
            <br>
            <br>
            <div class="col-sm-12 text-center">
                No open issues on this repository
            </div>
        </div>
    @endforelse
</div>