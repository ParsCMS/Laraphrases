<?php

class LaraphraseController extends BaseController {

    /**
     * Remote phrase update
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRemoteUpdate()
    {
        $class     = Input::get('class');
        $attribute = Input::get('attribute');

        if ( Laraphrase::isInWhiteList($class, $attribute) )
        {
            $id       = Input::get('id');
            $newValue = Input::get('newValue');
            //$record = $class::whereRaw('id = ? and aprove = 1', array($id))->get();
            $record = $class::where('aprove','1')->find($id);
            //dd($record);
            if ( is_null($record) ) return Response::json(['status' => 'error', 'message' => 'Phrase is not exists!'], 403);

            $record->fillable([$attribute]);

            $record->{$attribute} = $newValue;
            $record->create(['locale'=>'en','key'=>$attribute,'value'=>$newValue]);

            return Response::json($record->toJson());
        }
        return Response::json(['status' => 'error', 'message' => 'Attribute is not in white list!'], 403);
    }
    
    public function approve()
    {
        
        $id       = Input::get('id');
        $key      = Input::get('key');
        
        Phrase::where('aprove', 1)->where('key', $key)->update(array('votes' => 0));
        Phrase::where('id', $id)->update(array('votes' => 1));
        
        return true;
    }

}