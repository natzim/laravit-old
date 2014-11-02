<?php

class PostController extends BaseController {

  /**
   * Show a post
   * @param  int  $id
   * @return view
   */
  public function showPost($id)
  {
    $post = Post::find($id);

    // Validation here

    return View::make('post')
      ->with('title', $post->title);
  }

  /**
   * Create a new post
   * @return redirect
   */
  public function newPost()
  {
    $title = Input::get('title');
    $url   = Input::get('url');
    $sub   = Input::get('sub');

    $rules = array(
      'title' => 'required|max:100',
      'url'   => 'required|max:2083|active_url',
      'sub'   => 'required|exists:subs,name'
    );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails()) {
      Input::flash();

      return Redirect::to('submit')->withErrors($validator);
    } else {
      $post = Post::create(array(
        'title'   => Input::get('title'),
        'url'     => Input::get('url'),
        'sub_id'  => Sub::where('name', Input::get('sub'))->first()->id,
        'user_id' => Auth::user()->id
      ));

      return Redirect::to('p/' . $post->id);
    }
  }
}
