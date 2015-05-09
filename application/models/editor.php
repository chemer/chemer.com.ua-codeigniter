<?php

class Editor extends CI_Model
{
    private $id = 0;
    private $color = array('#ffffff','#f2f2f2','#cccccc','#999999','#666666','#545454','#333333','#000000','#ff3333','#ff0000','#cc3333','#cc0000','#993333','#990000','#660000','#ff00ff','#990099','#660066','#9933ff','#663399','#3300ff','#3300cc','#330099','#000066','#0066ff','#003399','#66ff66','#00ff00','#00cc00','#009900','#006600','#003300','#ffff99','#ffff33','#cccc00','#ffcc33','#cc9900','#ff9933','#cc6600','#663300','#663333','#ff6633');
    private $size = array('size 1','size 2','size 3','size 4','size 5','size 6','size 7');
    private $family = array('Arial','Courier','Georgia','Myriad Pro','Segoe Print','Tahoma','Times New Roman','Tunga','Verdana');
    
    /**
     * addToolbar() принимает параметры 'bold','italic','underline','left','center','right','ul','link','unlink','color','size','family','img'
     * для отображения только указанных аргументов
     */
    
    public function addToolbar()
    {
        $this->id++;
        if (func_num_args() == null) {
            echo '<div class="editor_toolbar" id="editor'.$this->id.'">';
            $this->print_bold();
            $this->print_italic();
            $this->print_underline();
            $this->print_left();
            $this->print_center();
            $this->print_right();
            $this->print_ul();
            $this->print_color();
            $this->print_size();
            $this->print_family();
            $this->print_link();
            $this->print_unlink();
            $this->print_img();
            echo '</div>';
            return;
        }
        echo '<div class="editor_toolbar" id="editor'.$this->id.'">';
        for ($i = 0; $i < func_num_args(); $i++) {
            switch (func_get_arg($i)) {
                case 'bold':
                    $this->print_bold();
                    break;
                case 'italic':
                    $this->print_italic();
                    break;
                case 'underline':
                    $this->print_underline();
                    break;
                case 'left':
                    $this->print_left();
                    break;
                case 'center':
                    $this->print_center();
                    break;
                case 'right':
                    $this->print_right();
                    break;
                case 'ul':
                    $this->print_ul();
                    break;
                case 'link':
                    $this->print_link();
                    break;
                case 'unlink':
                    $this->print_unlink();
                    break;
                case 'color':
                    $this->print_color();
                    break;
                case 'size':
                    $this->print_size();
                    break;
                case 'family':
                    $this->print_family();
                    break;
                case 'img':
                    $this->print_img();
                    break;
                default :
                    break;     
            }
        }
        echo '</div>';
    }
    
    /**
     * в методах print_bold()..... print_family(),
     * атрибут class тега img, должен быть идентичен 1-му параметру для метода execCommand,
     * исполбзуется в файле editor.js  
     */
    
    private function print_bold()
    {
        echo '<img class="bold" title="Bold" src="/images/editor/bold.png"/>';
    }
        
    private function print_italic()
    {
        echo '<img class="italic" title="Italic" src="/images/editor/italic.png"/>';
    }
    
    private function print_underline()
    {
        echo '<img class="underline" title="Underline" src="/images/editor/underline.png"/>';
    }
    
    private function print_left()
    {
        echo '<img class="JustifyLeft" title="Justify left" src="/images/editor/align_left.png"/>';
    }
            
    private function print_center()
    {
        echo '<img class="JustifyCenter" title="Justify center" src="/images/editor/align_center.png"/>';
    }
            
    private function print_right()
    {
        echo '<img class="JustifyRight" title="Justify right" src="/images/editor/align_right.png"/>';
    }
    
    private function print_ul()
    {
        echo '<img class="InsertUnorderedList" title="Unordered list" src="/images/editor/ul_editor.png"/>';
    }
    
    private function print_color()
    {
        echo '<div class="foreColor_box">
                <div class="foreColor_title"><div class="foreColor_title_color"></div>Color</div>
                <img class="foreColor_overhead" title="Font color" src="/images/editor/transparent.png"/>
                <div class="foreColor_dropbox">';      
        foreach ($this->color as $value) {
            echo '<img class="foreColor" src="/images/editor/transparent.png" style="background-color:'.$value.'"/>';
        }
        echo '</div></div>';
    }
    
    private function print_size ()
    {
        echo '<div class="fontSize_box">
                <div class="fontSize_title">Size <div class="fontSize_title_int"></div></div>
                <img class="fontSize_overhead" title="Font size" src="/images/editor/transparent.png"/>
                <div class="fontSize_dropbox">';        
        foreach ($this->size as $value) {
            echo '<div class="fontSize_dropbox_item">'.$value.'<img class="fontSize" src="/images/editor/transparent.png"/></div>';
        }
        echo '</div></div>';
    }

    private function print_family ()
    {
        echo '<div class="fontName_box">
                <div class="fontName_title">Family</div>
                <img class="fontName_overhead" title="Font name" src="/images/editor/transparent.png"/>
                <div class="fontName_dropbox">';       
        foreach ($this->family as $value) {
            echo '<div class="fontName_dropbox_item" style="font-family:'.$value.'">'.$value.'<img class="fontName" src="/images/editor/transparent.png"/></div>';
        }
        echo '</div></div>';
    }
    
    private function print_link ()
    {
        echo '<img class="createLink" title="Create link" src="/images/editor/link.png"/>';
    }
    
    private function print_unlink ()
    {
        echo '<img class="unlink" title="Unlink" src="/images/editor/unlink.png"/>';
    }
    
    private function print_img ()
    {
        echo '<img class="insertImage" title="Insert image" src="/images/editor/img.png"/>';
    }
    
}
?>
