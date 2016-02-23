resourcealert.grid.Snippets=function(config){config=config||{};this.sm=new Ext.grid.CheckboxSelectionModel();Ext.applyIf(config,{url:resourcealert.config.connector_url,baseParams:{action:'mgr/snippet/getlist',thread:config.thread},pageSize:300,fields:[{name:'id',sortType:Ext.data.SortTypes.asInt},{name:'name',sortType:Ext.data.SortTypes.asUCString},{name:'category',sortType:Ext.data.SortTypes.asUCString},{name:'description'}],paging:true,autosave:false,remoteSort:false,autoExpandColumn:'description',cls:'resourcealert-grid',sm:this.sm,columns:[this.sm,{header:_('id'),dataIndex:'id',sortable:true,width:50},{header:_('name'),dataIndex:'name',sortable:true,width:100},{header:_('category'),dataIndex:'category',sortable:true,width:120},{header:_('description'),dataIndex:'description',sortable:false,width:300}],viewConfig:{forceFit:true,enableRowBody:true,showPreview:true,getRowClass:function(rec,ri,p){var cls='resourcealert-row';if(this.showPreview)return cls+' resourcealert-resource-expanded';return cls+' resourcealert-resource-collapsed'}},tbar:[{text:'Bulk Actions',menu:this.getBatchMenu()},{xtype:'tbspacer',width:200},{xtype:'button',id:'resourcealert-snippets-reload',text:'reload',listeners:{click:{fn:this.reloadSnippets,scope:this}}}]});resourcealert.grid.Snippets.superclass.constructor.call(this,config)};Ext.extend(resourcealert.grid.Snippets,MODx.grid.Grid,{reloadSnippets:function(){this.getStore().baseParams={action:'mgr/snippet/getList',orphanSearch:'modSnippet'};this.getBottomToolbar().changePage(1);this.refresh()},_showMenu:function(g,ri,e){e.stopEvent();e.preventDefault();this.menu.record=this.getStore().getAt(ri).data;if(!this.getSelectionModel().isSelected(ri))this.getSelectionModel().selectRow(ri);this.menu.removeAll();var m=[];if(this.menu.record.menu){m=this.menu.record.menu;if(m.length>0){this.addContextMenuItem(m);this.menu.show(e.target)}}else{var z=this.getBatchMenu();for(var zz=0;zz<z.length;zz++)this.menu.add(z[zz]);this.menu.show(e.target)}},getSelectedAsList:function(){var sels=this.getSelectionModel().getSelections();if(sels.length<=0)return false;var cs='';for(var i=0;i<sels.length;i++)cs+=','+sels[i].data.id;cs=Ext.util.Format.substr(cs,1);return cs},changeCategory:function(btn,e){var cs=this.getSelectedAsList();if(cs===false)return false;var r={ids:cs};if(!this.changeCategoryWindow)this.changeCategoryWindow=MODx.load({xtype:'resourcealert-snippet-window-change-category',record:r,listeners:{success:{fn:function(r){var sels=this.getSelectionModel().getSelections(),cat=Ext.getCmp('resourcealert-snippet-category-combo').lastSelectionText,s=this.getStore();for(var i=0;i<sels.length;i=i+1){var id=sels[i].get('id'),ri=id,record=s.getById(ri);record.set("category",cat);record.commit()};this.getSelectionModel().clearSelections(false)},scope:this}}});this.changeCategoryWindow.setValues(r);this.changeCategoryWindow.show(e.target);return true},snippetRemove:function(){var cs=this.getSelectedAsList();if(cs===false)return false;MODx.msg.confirm({title:_('resourcealert.delete'),text:_('resourcealert.confirm_delete'),url:this.config.url,params:{action:'mgr/snippet/remove',ids:cs},listeners:{success:{fn:function(r){var sels=this.getSelectionModel().getSelections();if(sels.length<=0)return false;var s=this.getStore();for(var i=0;i<sels.length;i=i+1){var id=sels[i].get('id'),ri=id,record=s.getById(ri);s.remove(record)}},scope:this},failure:{fn:function(r){MODx.msg.alert()},scope:this}}});return true},getBatchMenu:function(){var bm=[];bm.push({text:_('new_category'),handler:this.changeCategory,scope:this},'-',{text:_('remove_snippet')+'(s)',handler:this.snippetRemove,scope:this});return bm}});Ext.reg('resourcealert-grid-snippet',resourcealert.grid.Snippets);resourcealert.window.ChangeCategory=function(config){config=config||{};Ext.applyIf(config,{title:_('new_category'),url:resourcealert.config.connector_url,baseParams:{action:'mgr/snippet/changecategory'},width:400,fields:[{xtype:'hidden',name:'snippets'},{xtype:'modx-combo-category',id:'resourcealert-snippet-category-combo',fieldLabel:_('category'),name:'category',hiddenName:'category',anchor:'90%'}]});resourcealert.window.ChangeCategory.superclass.constructor.call(this,config)};Ext.extend(resourcealert.window.ChangeCategory,MODx.Window);Ext.reg('resourcealert-snippet-window-change-category',resourcealert.window.ChangeCategory)