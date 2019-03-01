<?php
class ContentsController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Content.link_name'=>'asc'));
    public function index()
    {
        
    }    
    public function pages()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Content->parseCriteria($this->Prg->parsedParams());
        $this->set('Content', $this->Paginator->paginate());        
    }
    public function add()
    {
        if ($this->request->is('post'))
        {
            $this->Content->create();
            try
            {
                if ($this->Content->save($this->request->data))
                {
                    $this->Session->setFlash('Your Page has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'pages'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Page Url already exist.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'pages'));
            }
        }
    }
     public function edit($id = null)
    {
       
        if (!$id)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        $ids=explode(",",$id);
        $post=array();
        foreach($ids as $id)
        {
            $post[]=$this->Content->findById($id);
        }
        $this->set('Content',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Content->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Pages updated Successfully !','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'pages'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'pages'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = 'tinymce';
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
        
    }    
    public function deleteall()
    {
        
        if ($this->request->is('post'))
        {
            foreach($this->data['Content']['id'] as $key => $value)
            {
                if($value!=1 && $value!=2)
                $this->Content->delete($value);
            }
            $this->Session->setFlash('Your page has been deleted.','flash',array('alert'=>'success'));
        }
       
        $this->redirect(array('action' => 'pages'));
    }
     public function published($id=null,$mode=null)
    {
        
        
        if (!$id || !$mode)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'pages'));
        }
        $post = $this->Content->findById($id);
        if (!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'pages'));
        }
        $this->Content->id = $id;
        try
        {
            $published="";
            if($mode=="Yes")
            $published="Unpublished";
            else
            $published="Published";
            $userArr=array('id'=>$id,'published'=>$published);
            $this->Content->unbindValidation('remove', array('link_name','ordering','url'), true);
            if ($this->Content->save($userArr))
            {
                $this->Session->setFlash("Page has been $published.",'flash',array('alert'=>'success'));
                return $this->redirect(array('action' => 'pages'));
            }
            else
            {
                $this->Session->setFlash('Something wrong.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'pages'));            
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash('Something wrong.','flash',array('alert'=>'danger'));
            return $this->redirect(array('action' => 'pages'));            
        }
    }
}
