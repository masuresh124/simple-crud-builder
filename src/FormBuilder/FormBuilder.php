<?php
namespace Suresh\SimpleCrudBuilder\FormBuilder;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Suresh\SimpleCrudBuilder\Helpers\FormHelper;

class FormBuilder extends FormBuilderAbstract
{

    public static function createFormSimpleBuilder($entity, $formClass, $view, $actionUrl = null, $redirectTo = null, $message = null)
    {
        $request = request();
        try {

            $form       = app()->make($formClass)->createForm($entity);
            $className  = strtolower((new \ReflectionClass($entity))->getShortName());
            $pluralName = $className . 's';
            if ($request->method() == 'POST' || $request->method() == 'PUT') {

                if (FormHelper::isModelNew($entity)) {
                    $message = ($message) ? $message : "Created Successfully";
                } else {
                    $message = ($message) ? $message : "Updated Successfully";
                }

                $form->requestHandler($entity);
                $form->save();
                if ($request->ajax()) {
                    $response = [
                        'status'  => true,
                        'html'    => null,
                        'message' => $message,
                    ];
                    return response()->json($response);
                } else {
                    if ($message) {
                        Session::flash('success', $message);
                    }

                    $redirectTo = ($redirectTo) ? $redirectTo : $pluralName . '.index';
                    if ($redirectTo) {
                        return redirect()->route($redirectTo);
                    }
                }

            } else {

                if (FormHelper::isModelNew($entity)) {
                    $entity->method = 'create';
                    $entity->action = ($actionUrl) ? $actionUrl : route($pluralName . '.store');
                } else {
                    $entity->method = 'update';
                    $entity->action = ($actionUrl) ? $actionUrl : route($pluralName . '.update', [$className => $entity->id]);
                }

                $form = $form->buildForm($entity);
                if ($request->ajax()) {
                    $response = [
                        'status' => true,
                        'html'   => view($view, compact('entity', 'form'))->render(),
                    ];
                    return response()->json($response);
                } else {
                    return view($view, compact('entity', 'form'));
                }
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                $response = [
                    'status'  => false,
                    'html'    => null,
                    'message' => __('messages.contact_admin'),
                ];
                return response()->json($response);
            }
        }
    }

}
