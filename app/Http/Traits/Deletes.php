<?php

trait Deletes {
  /**
   * Soft delete the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      return $this->model()::where('id', $id)->delete();
  }

  /**
   * Display the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function trashed()
  {
      return new JsonResource($this->model()::onlyTrashed()->get());
  }

  /**
   * Restore the specified resource in storage.
   *
   * @return \Illuminate\Http\Response
   */
  public function restore($id)
  {
      return new JsonResource(User::where('id', $id)->restore());
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
      return new JsonResource($this->model()::where('id', $id)->forceDelete());
  }
}
