<?php

class VoteController extends BaseController {

    /**
     * Add a new vote
     * @return void
     */
    public function vote()
    {
        $class        = Input::get('class');
        $postId       = Input::get('postId');
        $previousVote = PostVote::where('user_id', Auth::id())->where('post_id', $postId)->first();
        $isUpvote     = str_contains($class, 'up');

        // If there is a vote by the same user on the same post
        if (!is_null($previousVote))
        {
            if ($isUpvote)
            {
                if ($previousVote->type === 'up')
                {

                    // Cancel out previous upvote
                    $previousVote->delete();
                }
                else
                {
                    $previousVote->update(['type' => 'up']);
                }
            }
            else
            {
                if ($previousVote->type === 'down')
                {

                    // Cancel out previous downvote
                    $previousVote->delete();
                }
                else
                {
                    $previousVote->update(['type' => 'down']);
                }
            }
        }
        else
        {

            // Create a new vote
            PostVote::create([
                'type'    => $isUpvote ? 'up' : 'down',
                'user_id' => Auth::id(),
                'post_id' => $postId
            ]);
        }
    }
}
