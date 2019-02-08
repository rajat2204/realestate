<?php
class SlidesController extends AdminAppController {
    public $helpers = array('Html', 'Form','Session','Paginator');
    public $components = array('Session','Paginator','search-master.Prg');
    public $presetVars = true;
    var $paginate = array('limit'=>20,'maxLimit'=>500,'page'=>1,'order'=>array('Slide.slide_name'=>'asc'));
    public function index()
    {
        $this->Prg->commonProcess();
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings['conditions'] = $this->Slide->parseCriteria($this->Prg->parsedParams());
        $this->set('Slide', $this->Paginator->paginate());
    }    
    public function add()
    {
        if ($this->request->is('post'))
        {
            if ($this->request->is('post'))
            {
                $this->Slide->create();
                try
                {
                    if ($this->Slide->save($this->request->data))
                    {
                        $this->Session->setFlash('Slide has been saved.','flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash('Slide Name already exist.','flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            $this->set('isError',true);
        }        
        else
        {
            $this->layout = null;
            $this->set('isError',false);
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
            $post[]=$this->Slide->findById($id);
        }
        $this->set('Slide',$post);
        if (!$post)
        {
            throw new NotFoundException(__('Invalid post'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                if ($this->Slide->saveAll($this->request->data))
                {
                    $this->Session->setFlash('Slide has been saved.','flash',array('alert'=>'success'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
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
            foreach($this->data['Slide']['id'] as $key => $value)
            {
                $this->Slide->delete($value);
            }
            $this->Session->setFlash('Slide has been deleted.','flash',array('alert'=>'success'));
        }        
        $this->redirect(array('action' => 'index'));
    }
    public function view($id = null)
    {
        $this->layout = null;
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Slide->findById($id);
        if (!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if(strlen($post['Slide']['photo'])>0)
        $photoImg='slides_thumb/'.$post['Slide']['photo'];
        else
        $photoImg='Blank.jpg';
        $this->set('photoImg',$photoImg);        
    }
    public function changephoto($id=null)
    {
        if (!$id)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Slide->findById($id);
        if (!$post)
        {
            $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is(array('post', 'put')))
        {
            try
            {
                $this->Slide->id = $id;
                $this->Slide->unbindValidation('keep', array('photo'), true);
                if ($this->Slide->save($this->request->data))
                {
                    $this->Session->setFlash('Photo Changed Successfully','flash',array('alert'=>'success'));
                    $this->redirect(array('action' => 'index'));
                }
            }
            catch (Exception $e)
            {
                $this->Session->setFlash('Invalid Post.','flash',array('alert'=>'danger'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->set('isError',true);
        }
        else
        {
            $this->layout = null;
            $this->set('isError',false);
        }
        if (!$this->request->data)
        {
            $this->request->data = $post;
        }
    }
}
