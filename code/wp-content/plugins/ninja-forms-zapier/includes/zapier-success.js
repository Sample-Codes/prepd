jQuery(document).ready(function($){
    var Controller =  Marionette.Object.extend( {
        initialize: function() {
            this.listenTo( Backbone.Radio.channel( 'app' ), 'response:updateDB', this.afterPublish );
        },
        afterPublish: function( response ) {

            if( 'publish' != response.action ) return;
            if( 'undefined' == typeof response.data.zapier ) return;
            if( 'undefined' == typeof response.data.zapier.zapier_sync ) return;
            var sync = response.data.zapier.zapier_sync;
            Backbone.Radio.channel( 'notices' )
                .request(
                    'add',
                    'zapier_sync', /* Slug */
                    ( sync ) ? 'Changes Synced with Zapier' : 'Zapier Sync Failed, Check URL', /* Message */
                    { /* Options object */
                        color: ( sync ) ? 'green' : 'yellow',
                    }
                );
        },
    });
    new Controller();
});