<?php

namespace App\Http\Controllers;

use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ReposController extends Controller
{
    private $client;
    private $gituser;
    public function __construct(GitHubManager $client)
    {
        $this->client = $client;
        $this->gituser = \Auth::user()->nickname;
    }

    public function show($repo, Request $request){

        if($request->has('filter') && $request->has('value')){

            $filter = $request->input('filter');
            $value = $request->input('value');

            if($filter == 'milestone'){
                $issues = $this->client->api('issue')->all($this->gituser, $repo, array('state' => 'open', 'milestone'=>$value));
            }
            elseif($filter == 'label'){
                $issues = $this->client->api('issue')->all($this->gituser, $repo, array('state' => 'open', 'labels'=>$value));
            }
            elseif($filter == 'member'){
                $issues = $this->client->api('issue')->all($this->gituser, $repo, array('state' => 'open', 'assignee'=>$value));
            }

            $request->flash();

        }else{
            $issues = $this->client->api('issue')->all($this->gituser, $repo, array('state' => 'open'));
        }

        $labels = $this->client->api('issue')->labels()->all($this->gituser, $repo);
        $milestones = $this->client->api('issue')->milestones()->all($this->gituser, $repo);
        $members = $this->client->api('repo')->contributors($this->gituser, $repo);

        $lbs = [];
        foreach($labels as $label){
            $lbs[$label['name']] = $label['name'];
        }

        $mbrs = [];
        foreach($members as $member){
            $mbrs[$member['login']] = $member['login'];
        }

        $mlstns = [];
        foreach($milestones as $milestone){
            $mlstns[$milestone['number']] = $milestone['title'];
        }

        foreach($issues as &$issue){
            $issue['all_comments'] = $this->client->api('issue')->comments()->all($this->gituser, $repo, $issue['number']);
        }

        return view('repos.show')->with(
            [
                'current_repo' => $repo,
                'issues' => $issues,
                'milestones' => $mlstns,
                'labels' => $lbs,
                'members' => $mbrs
            ]
        );
    }

    public function addComment($repo, $issue, Request $request){
        $this->client->authenticate($this->gituser, $request->password, \Github\Client::AUTH_HTTP_PASSWORD);
        try{
            $this->client->api('issue')->comments()->create($this->gituser, $repo, $issue, array('body' => $request->input('comment')));
        }catch(\Exception $e){
            return view('repos.failed', ['back' => URL::previous()]);
        }

        return redirect()->back();
    }
}
