
 

var SkuSelection = {
    props: ['skulistprop', 'skumixid'],
    data: function() {
        return {
            counter: 1,
            
        }
    },
    computed: {
        pageindex: function() {
            var self = this;
            
            return tmp;
        }
    },
    template: [
        '<div class="ui fluid multiple search selection dropdown">',
            '<input type="hidden" name="country" value="">',
            '<i class="dropdown icon"></i>',
            '<input class="search" autocomplete="off" tabindex="0" style="width: 9px;"><span class="sizer"></span>',
            '<div class="default text">Select Sku</div>',
            '<div  class="menu transition hidden "  tabindex="-1">',
                '<div v-for="sku in skulistprop" class="item" :data-value="sku.barcode"><img :src="sku.photo"/>{{sku.skuName}}</div>',
            '</div>',
        '</div>'
    ].join(''),
    mounted: function(){
        var self = this;
        $(self.$el).dropdown('set selected', self.selectedvalue).dropdown({
            onChange: function(value, text, $selectedItem) {
                self.$emit('skuselected', self.skumixid, value);
                // $(self.$el).dropdown('setting', 'set selected', '');

            }
        });
    },
    methods: {
        pageclickhandler: function(e) {
            var self = this;
            // self.$emit('activepagechanged', pageindex)
        }
    }
}

new Vue({
    el: '#app',
    data: {
        skulist: [],
        skulistavailable:[],
        newsku: {},
        newskumix: {},
        skumixlist: []
    },
    computed: {
        // seasonalRiskList: function() {
        //     var self = this;
        //     var tmp = [];
        //     var classList = [
        //         'text-warning',
        //         'text-primary',
        //         'text-info',
        //         'text-alert'
        //     ]
        //     $.each(self.seasonalRiskListRaw, function(k, v) {
        //         tmp.push($.extend({}, v, {
        //             className: classList[k]
        //         }))
        //     })
        //     console.log(tmp)
        //     return tmp;
        // },
        // token: function() {
        //     return getCookie('token')
        // }
    },
    components: {
        'skuselection': SkuSelection
    },
    mounted: function() {
        var self = this;
        self.getSkuList();
   
    // $('.ui.card').on('click', '.ui.move.reveal.image', function(){
    $('.ui.card').on('click', '.canclick', function() {
        $(this).toggleClass('active');
    })
    $('.ui.sticky').sticky();
    // $('tr').on('click', function(){
    //   window.location.href = "./detail.html"
    // })
    },
    methods: {

        toggleView: function(e){
            e.preventDefault();
            e.stopPropagation();
            $(e.target).closest('.ui.card').find('.sku').transition('toggle');
        },
        togglePhotoModel: function(e){
            var self = this;
            $(e.target).closest('.ui.card').toggleClass('compare');
            $('.ui.move.reveal.image').toggleClass('canclick').removeClass('active');
        },
        getSkuList: function() {
            var self = this;

            $.ajax({
                method: "GET",
                // url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                // url: "http://192.168.1.5/mixmatch/Api/GetSkuList.php",
                // url: "http://10.32.80.152:8099/mixmatch/Api/GetSkuList.php",
                // url: "http://192.168.0.104/mixmatch/Api/GetSkuList.php",
                url:"http://10.32.80.152:8099/mixmatch-tp5/public/index/index/getSkuList",
                data: {}
            }).always(function(res) {
                //假数据START
                
                //假数据END
                console.log(res)
                
                self.skulist = _.extend([], res);
                var filtered = _.filter(res, function(sku){
                        return sku.skuStatus == 1;
                    })
                console.log(filtered)
                self.skulistavailable = filtered;
                self.getSkuMixList();

            });
        },
        getSkuMixList: function() {
            var self = this;

            $.ajax({
                method: "GET",
                // url: "http://127.0.0.1/mixmatch/Api/GetSkuList.php",
                // url: "http://192.168.1.5/mixmatch/Api/GetSkuMixList.php",
                // url: "http://10.32.80.152:8099/mixmatch/Api/GetSkuMixList.php",
                // url: "http://192.168.0.104/mixmatch/Api/GetSkuMixList.php",
                url:"http://10.32.80.152:8099/mixmatch-tp5/public/index/index/getSkuMixList",
                data: {}
            }).always(function(res) {
                //假数据START
               
                //假数据END
                console.log(res)
                
                self.skumixlist = res;
                _.each(self.skumixlist, function(skumix, k){
                    self.skumixlist[k]['skuMixArray'] =  _.filter(self.skulist, function(sku){
                        return _.indexOf(skumix.skuMix.split(','), sku.barcode) > -1
                    })
                })
                console.log(self.skumixlist)
            });
        },
        saveSkuMix: function(e) {
            var self = this;
            var formData = new FormData();
            formData.append("skuMixName", self.newskumix.skuName);
            formData.append("skuMixType", self.newskumix.skuType);
            formData.append("price", self.newskumix.price);
            // formData.append("skuMix", '2,3,24,36');
            formData.append("skuMix", self.newskumix.skuMix);
            // HTML 文件类型input，由用户选择
            formData.append("photo", $('#photo')[0].files[0]);
            formData.append("photoModel", $('#photoModel')[0].files[0]);
            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuAction.php?action=add",
                // url: "http://192.168.1.5/mixmatch/Api/SkuMixAction.php?action=add",
                url: "http://10.32.80.152:8099/mixmatch/Api/SkuMixAction.php?action=add",
                // url: "http://192.168.0.104/mixmatch/Api/SkuMixAction.php?action=add",
                // data: {
                //     sku: formData
                // },
                data:formData,
                processData: false,
                contentType: false
            }).always(function(res) {
                //假数据START
                
                //假数据END
                if(res.success) {
                   self.newskumix = {};
                } else {
                    alert('error')
                   
                }
                self.getSkuMixList(); 
                

            });
        },
        skuSelectionHandler: function(skuMixId, skuMix){
            var self = this;
            if(!skuMixId) {
                self.newskumix.skuMix = skuMix;
            } else {
                var target = _.find(self.skumixlist, function(skumix){
                    if(skumix.id == skuMixId) {
                        console.log(skumix.skuMix)
                        console.log(skuMix)
                        skumix.skuMix =  skumix.skuMix  + ',' + skuMix;
                        console.log(skumix)
                        return true;
                    }
                    // return skumix.id == skuMixId
                })
                console.log('====')
                console.log(target)
                // console.log(target.skuMix)
                // console.log(skuMix)
                // var res = _.union(target.skuMix,skuMix);

                // console.log(res)

                self.updateSkuMixArraySingle(skuMixId);
            }

        },
        removeSku: function(e){
            var self = this;
            var skumixid = $(e.target).closest('.column').attr('data-skumixid');
            var skuid = $(e.target).closest('.column').attr('data-skuid');

            var target = _.find(self.skumixlist, function(skumix){
                    if(skumix.id == skumixid) {
                        skumix.skuMix =  skumix.skuMix.replace(skuid, '');
                        console.log(skumix)
                        return true;
                    }
                })
                self.updateSkuMixArraySingle(skumixid);



        },
        updateSkuMixArraySingle: function(skuMixId){
            var self = this;
            var target = _.find(self.skumixlist, function(skumix){
                    return skumix.id == skuMixId
                    })
            console.log(target)
            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuMixAction.php?action=updatesingle",
                // url: "http://192.168.1.5/mixmatch/Api/SkuMixAction.php?action=updatesingle",
                url: "http://10.32.80.152:8099/mixmatch/Api/SkuMixAction.php?action=updatesingle",
                // url: "http://192.168.0.104/mixmatch/Api/SkuMixAction.php?action=updatesingle",
                data: {
                    id: target.id,
                    skuMix: target.skuMix
                },
            }).always(function(res) {
                //假数据START
                // res ={
                //     "result":[
                //         {
                //             "name":"1D风险价值",
                //             "per95":"0.64",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"1D预期收益不足",
                //             "per95":"0.64",
                //             "per99":"0.52"
                //         },
                //         {
                //             "name":"10D风险价值",
                //             "per95":"0.44",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"10D预期收益不足",
                //             "per95":"0.78",
                //             "per99":"0.63"
                //         }],
                //         "code":"",
                //         "resultMassage":"",
                //         "success":true
                //     }
                //假数据END
                // console.log(res)
                self.getSkuMixList();

            });
        },
        updateSkuMix: function(e) {
            var self = this;
            var id = $(e.target).closest('.skumixid').attr('data-skumixid');
            var photoinput = $(e.target).parent().siblings('.test').find('.updatephoto');


            console.log(photoinput)
            var photomodelinput = $(e.target).parent().siblings('.test').find('.updatephotomodel')
            console.log(self.skumixlist)

            var target = _.find(self.skumixlist, function(skumix){
                // console.log(skumix)
                console.log(id)
                return skumix.id == id
            })

            console.log(target)



            var formData = new FormData();
            formData.append("id", id);
            formData.append("skuMixName", target.skuMixName);
            formData.append("skuMixType", target.skuMixType);
            formData.append("skuMix", target.skuMix);
            formData.append("skuMixStatus", target.skuMixStatus);
            formData.append("channel", target.channel);
            formData.append("size", target.size);
            formData.append("price", target.price);
            // HTML 文件类型input，由用户选择
            if(photoinput[0].files[0]) {
                formData.append("photo", photoinput[0].files[0]);
            } else {
                formData.append("photo", target.photo);
            }

            if(photomodelinput[0].files[0]) {
                formData.append("photoModel", photomodelinput[0].files[0]);
            } else {
                formData.append("photoModel", target.photoModel);
            }

            $.ajax({
                method: "POST",
                // url: "http://127.0.0.1/mixmatch/Api/SkuMixAction.php?action=update",
                // url: "http://192.168.1.5/mixmatch/Api/SkuMixAction.php?action=update",
                url: "http://10.32.80.152:8099/mixmatch/Api/SkuMixAction.php?action=update",
                // url: "http://192.168.0.104/mixmatch/Api/SkuMixAction.php?action=update",
                data: formData,
                processData: false,
                contentType: false
            }).always(function(res) {
                //假数据START
                // res ={
                //     "result":[
                //         {
                //             "name":"1D风险价值",
                //             "per95":"0.64",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"1D预期收益不足",
                //             "per95":"0.64",
                //             "per99":"0.52"
                //         },
                //         {
                //             "name":"10D风险价值",
                //             "per95":"0.44",
                //             "per99":"0.63"
                //         },
                //         {
                //             "name":"10D预期收益不足",
                //             "per95":"0.78",
                //             "per99":"0.63"
                //         }],
                //         "code":"",
                //         "resultMassage":"",
                //         "success":true
                //     }
                //假数据END
                // console.log(res)
                self.getSkuMixList();

            });
        },
        // // toggleModal: function(){
        // //     var self = this;
        // //     $('.ui.modal').modal('show');

        // // },
        // vmodelSkuStatus: function(skuid, value){
        //     var self = this;
        //     if(skuid) {
        //        var target = _.find(self.skulist, function(sku){
        //         return sku.barcode == skuid
        //         })
        //         target.skuStatus = value; 
        //         // self.updateSku();
        //     // var barcode = $(e.target).closest('tr').attr('data-skuid');
        //         $("[data-skuid='" + skuid + "']").find('.ui.button.orange').trigger('click');
        //     } else {
        //         //新增sku
        //         self.newsku.skuStatus = value;
        //     }
            
        // },
        // cancelSku: function(){
        //     var self = this;
        //     self.getSkuList();
        // },
        // deleteSku: function(){
        //     var self = this;
        // }

    }
})