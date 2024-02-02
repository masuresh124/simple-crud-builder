<?php

namespace Suresh\SimpleCrudBuilder\FormBuilder;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Suresh\SimpleCrudBuilder\FormBuilder\Entity\FormEntity;
use Suresh\SimpleCrudBuilder\Helpers\FormHelper;
use Suresh\SimpleCrudBuilder\View\Components\Text;
use Suresh\SimpleCrudBuilder\View\Components\TextArea;

abstract class Form
{

    public $fields;
    public $model;
    public $modelName;
    public $modelPath;
    public $modelSingleton;
    public $entity;

    const TEXT     = 'text';
    const TEXTAREA = 'text-area';

    abstract public function createForm($entity);

    public function __construct()
    {
        $this->fields = new collection;
    }

    public function add($type, $name, $options = [])
    {
        $this->addCore($this, $type, $name, $options);
    }

    /**
     * Add form
     */
    public function addCore($form, $type, $name, $options = [])
    {

        $field           = new FormEntity;
        $field->type     = $type;
        $field->keyName  = $name;
        $field->name     = $name;
        $field->required = FormHelper::validInput($options, 'required');
        $field->label    = FormHelper::validInput($options, 'label');

        switch ($type) {
            case self::TEXT:
                $field->placeHolder = FormHelper::validInput($options, 'placeHolder');
                if (!$field->placeHolder) {
                    $field->placeHolder = $this->generatePlaceHolder($name, $type);
                }
                break;
            case self::TEXTAREA:
                $field->placeHolder = FormHelper::validInput($options, 'placeHolder');
                if (!$field->placeHolder) {
                    $field->placeHolder = $this->generatePlaceHolder($name, $type);
                }
                break;
            default:
                break;
        }

        $form->fields->put($name, $field);
    }

    public function buildForm($entity)
    {
        if ($entity && $entity->id) {
            $this->model = $entity;
        }
        $this->coreBuildForm($this, $entity);
        return $this;
    }

    public function coreBuildForm($form, $entity)
    {

        foreach ($form->fields as $field) {

            $fieldEntity           = new FormEntity;
            $fieldEntity->type     = $field->type;
            $fieldEntity->keyName  = $field->keyName;
            $fieldEntity->name     = $field->name;
            $fieldEntity->required = $field->required;
            $fieldEntity->label    = $field->label;

            if (is_object($entity)) {
                $fieldEntity->value = $entity->{$fieldEntity->keyName} ? $entity->{$fieldEntity->keyName} : '';
            }

            switch ($fieldEntity->type) {
                case self::TEXT:
                    $fieldEntity->placeHolder = $field->placeHolder;
                    $fieldRender              = new Text($fieldEntity->name, $fieldEntity->value, $fieldEntity->label, $fieldEntity->placeHolder, $fieldEntity->required);
                    $view                     = $fieldRender->render()->with($fieldRender->data());
                    if ($form->fields->has($fieldEntity->keyName)) {
                        $fieldObject       = $form->fields->get($fieldEntity->keyName);
                        $fieldObject->view = $view;
                    }
                    break;
                case self::TEXTAREA:
                    $fieldEntity->placeHolder = $field->placeHolder;
                    $fieldRender              = new TextArea($fieldEntity->name, $fieldEntity->value, $fieldEntity->label, $fieldEntity->placeHolder, $fieldEntity->required);
                    $view                     = $fieldRender->render()->with($fieldRender->data());
                    if ($form->fields->has($fieldEntity->keyName)) {
                        $fieldObject       = $form->fields->get($fieldEntity->keyName);
                        $fieldObject->view = $view;
                    }
                    break;
            }
        }

        return $this;
    }

    public function requestHandler($entity)
    {
        $request = request()->all();
        $this->requestHandlerCore($this, $entity, $request);
    }

    public function requestHandlerCore($form, $entity, $request = [])
    {
        $hasRequest = false;
        foreach ($form->fields as $field) {
            $name = $field->keyName;
            switch ($field->type) {
                case self::TEXT:
                case self::TEXTAREA:
                    if (Arr::has($request, $name)) {
                        $entity->{$name} = Arr::get($request, $name);
                    }
                    break;

            }
        }

        if (is_array($request) && count($request) > 0 || $hasRequest) {
            $form->model = $entity;
        } else {
            $form->model = null;
        }

        return $entity;
    }

    public function save(callable $beforeInsert = null, callable $afterInsert = null)
    {
        DB::beginTransaction();
        $this->saveCore($this);
        DB::commit();

    }

    public function saveCore($form)
    {
        if ($form->model) {
            $form->model->save();
        }
    }

    public function textArea($name)
    {
        return $this->textCore($this, $name);
    }
    public function text($name)
    {
        return $this->textCore($this, $name);
    }
    public function textCore($form, $name, $options = [])
    {
        if ($form->fields->has($name)) {
            return $form->fields->get($name)->view;
        }
        return null;
    }

    public function generatePlaceHolder($name, $type)
    {
        $label       = $this->generateLable($name);
        $placeHolder = '';
        switch ($type) {
            case 'text':
                $placeHolder = "Enter your" . ' ' . $label;
                break;
        }
        return $placeHolder;
    }
    public function generateLable($name)
    {
        $name   = $name;
        $name   = str::ucfirst($name);
        $newstr = preg_replace('/([a-z])([A-Z])/s', '$1 $2', $name);
        return $newstr;
    }

}
