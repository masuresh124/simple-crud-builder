<?php

namespace Masuresh124\SimpleCrudBuilder\FormBuilder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Masuresh124\SimpleCrudBuilder\FormBuilder\Entity\FormEntity;
use Masuresh124\SimpleCrudBuilder\Helpers\FormHelper;

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
    const RADIO    = 'radio';
    const CHECKBOX = 'check';
    const DROPDOWN = 'drop-down';
    const FILE     = 'file';

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

        $field          = new FormEntity;
        $field->type    = $type;
        $field->keyName = $name;
        $field->name    = $name;

        switch ($type) {
            case self::TEXT:
            case self::TEXTAREA:
                $field->required    = FormHelper::validInput($options, 'required');
                $field->label       = FormHelper::validInput($options, 'label');
                $field->placeHolder = FormHelper::validInput($options, 'placeHolder');
                if (!$field->placeHolder) {
                    $field->placeHolder = $this->generatePlaceHolder($name, $type);
                }
                break;
            case self::RADIO:
                $field->choices = FormHelper::validInput($options, 'choices');
                break;
            case self::CHECKBOX:
                $field->required = FormHelper::validInput($options, 'required');
                $field->label    = FormHelper::validInput($options, 'label');
                break;
            case self::DROPDOWN:
                $field->required    = FormHelper::validInput($options, 'required');
                $field->label       = FormHelper::validInput($options, 'label');
                $field->placeHolder = FormHelper::validInput($options, 'placeHolder');
                $field->choices     = FormHelper::validInput($options, 'choices');
                break;
            case self::FILE:
                $field->required = FormHelper::validInput($options, 'required');
                $field->label    = FormHelper::validInput($options, 'label');
                $field->path     = FormHelper::validInput($options, 'path');
                $field->disk     = FormHelper::validInput($options, 'disk');
                $field->disk     = ($field->disk) ? $field->disk : 'local';
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

        foreach ($form->fields as $fieldEntity) {
            if (!$form->fields->has($fieldEntity->keyName)) {
                throw new \Exception("Unauthorized Component");
            }

            if (!is_object($entity) || !$entity instanceof Model) {
                throw new \Exception("Model not found");
            }

            $fieldObject        = $form->fields->get($fieldEntity->keyName);
            $attributes         = $entity->getAttributes() ?: [];
            $fieldEntity->value = array_key_exists($fieldEntity->keyName, $attributes) ? $entity->{$fieldEntity->keyName} : '';

            switch ($fieldEntity->type) {
                case self::TEXT:
                    $fieldObject->view = FormComponent::text($fieldEntity);
                    break;
                case self::TEXTAREA:
                    $fieldObject->view = FormComponent::textArea($fieldEntity);
                    break;
                case self::RADIO:
                    $fieldObject->view = FormComponent::radio($fieldEntity);
                    break;
                case self::CHECKBOX:
                    $fieldObject->view = FormComponent::checkBox($fieldEntity);
                    break;
                case self::DROPDOWN:
                    $fieldObject->view = FormComponent::dropDown($fieldEntity);
                    break;
                case self::FILE:
                    if ($fieldEntity->value && Storage::disk($fieldEntity->disk)->exists($fieldEntity->value)) {
                        $fieldEntity->value = Storage::disk($fieldEntity->disk)->url($fieldEntity->value);
                    } else {
                        $fieldEntity->value = null;
                    }
                    $fieldObject->view = FormComponent::file($fieldEntity);
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

        foreach ($form->fields as $field) {
            $name = $field->keyName;
            switch ($field->type) {
                case self::TEXT:
                case self::TEXTAREA:
                case self::DROPDOWN:
                    if (Arr::has($request, $name)) {
                        $entity->{$name} = Arr::get($request, $name);
                    }
                    break;

                case self::CHECKBOX:
                case self::RADIO:
                    $entity->{$name} = 0;
                    if (Arr::has($request, $name)) {
                        $entity->{$name} = Arr::get($request, $name);
                    }
                    break;
                case self::FILE:
                    if (Arr::has($request, $name)) {
                        $tempFile     = Arr::get($request, $name);
                        $path         = $field->disk == 'local' ? 'public/' . $field->path : $field->path;
                        $filename     = time() . '_' . $tempFile->getClientOriginalName();
                        $uploadedFile = Storage::disk($field->disk)->putFileAs($path, $tempFile, $filename);

                        if (Storage::disk($field->disk)->exists($uploadedFile)) {
                            $entity->{$name} = $uploadedFile;
                        }
                    }
                    break;

            }
        }

        if (is_array($request) && count($request) > 0) {
            $form->model = $entity;
        } else {
            $form->model = null;
        }

        return $entity;
    }

    public function save()
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

    public function file($name)
    {
        return $this->textCore($this, $name);
    }
    public function dropDown($name)
    {
        return $this->textCore($this, $name);
    }
    public function checkBox($name)
    {
        return $this->textCore($this, $name);
    }
    public function radio($name)
    {
        return $this->textCore($this, $name);
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
