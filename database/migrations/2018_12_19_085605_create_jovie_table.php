<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            Schema::create('users', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->string('first_name');
                $table->string('last_name')->nullable();
                $table->string('email')->index();
                $table->string('username')->nullable();
                $table->string('title')->nullable();
                $table->string('employer')->nullable();
                $table->string('employer_link')->nullable();
                $table->string('call_to_action_text')->nullable();
                $table->mediumText('call_to_action')->nullable();
                $table->boolean('is_verified')->nullable();
                $table->boolean('is_admin')->default(false);
                $table->text('profile_pic_url')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
                $table->string('stripe_id')->nullable()->index();
                $table->string('pm_type')->nullable();
                $table->string('pm_last_four', 4)->nullable();
                $table->timestamp('trial_ends_at')->nullable();
                $table->boolean('show_instagram')->nullable()->default(true);
                $table->boolean('show_twitch')->nullable()->default(true);
                $table->boolean('show_onlyFans')->nullable()->default(true);
                $table->boolean('show_snapchat')->nullable()->default(true);
                $table->boolean('show_linkedin')->nullable()->default(true);
                $table->boolean('show_youtube')->nullable()->default(true);
                $table->boolean('show_twitter')->nullable()->default(true);
                $table->boolean('show_tiktok')->nullable()->default(true);
                $table->uuid('current_team_id')->nullable();
                $table->integer('queued_count')->nullable()->default(0);
                $table->string('instagram_handler')->nullable();
                $table->string('twitter_handler')->nullable();
                $table->string('facebook_handler')->nullable();
                $table->string('youtube_handler')->nullable();
                $table->string('twitch_handler')->nullable();
                $table->string('spotify_handler')->nullable();
                $table->string('apple_music_handler')->nullable();
                $table->string('soundcloud_handler')->nullable();
                $table->string('linkedin_handler')->nullable();
                $table->string('tiktok_handler')->nullable();
            });

            Schema::create('password_resets', function (Blueprint $table) {
                $table->comment('');
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });

            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->comment('');
                $table->id();
                $table->string('tokenable_type');
                $table->uuid('tokenable_id');
                $table->string('name');
                $table->string('token', 64)->index();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamps();

                $table->index(['tokenable_type', 'tokenable_id']);
            });

            Schema::create('team_invites', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->enum('type', ['invite', 'request']);
                $table->string('email');
                $table->string('accept_token');
                $table->string('deny_token');
                $table->timestamps();
            });

            Schema::create('team_user', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->timestamps();
            });

            Schema::create('teams', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('owner_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->string('name');
                $table->timestamps();
                $table->string('stripe_id')->nullable()->index();
                $table->string('pm_type')->nullable();
                $table->string('pm_last_four', 4)->nullable();
                $table->timestamp('trial_ends_at')->nullable();
                $table->integer('credits')->nullable();
            });

            Schema::create('creators', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->boolean('platform_verified')->nullable()->default(false);
                $table->string('platform_username')->nullable();
                $table->string('platform_title')->nullable();
                $table->string('platform_employer')->nullable();
                $table->string('platform_employer_link')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('full_name')->nullable();
                $table->mediumText('emails')->nullable();
                $table->string('gender')->nullable();
                $table->uuid('gender_accuracy')->nullable()->default(0);
                $table->boolean('gender_updated')->nullable()->default(false);
                $table->string('location')->nullable()->index();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('phone')->nullable();
                $table->string('website')->nullable();
                $table->string('type')->nullable();
                $table->string('account_type')->nullable();
                $table->text('tags')->nullable();
                $table->text('social_links')->nullable();
                $table->string('instagram_handler')->nullable()->index();
                $table->string('instagram_name')->nullable();
                $table->string('instagram_category')->nullable();
                $table->boolean('instagram_name_updated')->nullable()->default(false);
                $table->double('instagram_followers')->nullable();
                $table->text('instagram_biography')->nullable();
                $table->string('instagram_email')->nullable();
                $table->double('instagram_engagement_rate')->default(0)->index();
                $table->boolean('instagram_is_verified')->default(false)->index();
                $table->boolean('instagram_is_private')->default(false)->index();
                $table->longText('instagram_media')->nullable();
                $table->longText('instagram_meta')->nullable();
                $table->string('tiktok_handler')->nullable();
                $table->string('tiktok_name')->nullable();
                $table->string('tiktok_category')->nullable();
                $table->boolean('tiktok_name_update')->nullable()->default(false);
                $table->double('tiktok_followers', 20, 2)->nullable();
                $table->text('tiktok_biography')->nullable();
                $table->double('tiktok_engagement_rate')->nullable()->default(0)->index();
                $table->boolean('tiktok_is_verified')->nullable()->default(false)->index();
                $table->boolean('tiktok_is_private')->nullable()->default(false)->index();
                $table->longText('tiktok_media')->nullable();
                $table->longText('tiktok_meta')->nullable();
                $table->string('twitter_handler')->nullable();
                $table->string('twitter_name')->nullable();
                $table->string('twitter_category')->nullable();
                $table->boolean('twitter_name_update')->nullable()->default(false);
                $table->double('twitter_followers', 20, 2)->nullable();
                $table->text('twitter_biography')->nullable();
                $table->string('youtube_handler')->nullable();
                $table->string('linkedin_handler')->nullable();
                $table->string('snapchat_handler')->nullable();
                $table->string('onlyFans_handler')->nullable();
                $table->string('twitch_handler')->nullable();
                $table->string('twitch_id')->nullable()->index();
                $table->string('twitch_name')->nullable()->index();
                $table->string('twitch_category')->nullable()->index();
                $table->text('twitch_biography')->nullable();
                $table->text('twitch_meta')->nullable();
                $table->bigInteger('twitch_average_viewers')->nullable();
                $table->bigInteger('twitch_followers')->nullable();
                $table->boolean('twitch_is_verified')->default(false)->index();
                $table->double('twitch_engagement_rate')->nullable()->default(0)->index();
                $table->string('wiki_id')->nullable();
                $table->uuid('user_id')->nullable();
                $table->timestamps();
                $table->double('twitter_engagement_rate')->nullable()->default(0)->index();
                $table->boolean('twitter_is_verified')->nullable()->default(false)->index();
                $table->boolean('twitter_is_private')->nullable()->default(false)->index();
                $table->longText('twitter_media')->nullable();
                $table->longText('twitter_meta')->nullable();
                $table->dateTime('instagram_last_scrapped_at')->nullable();
                $table->timestamp('twitch_last_scrapped_at')->nullable();
                $table->dateTime('twitter_last_scrapped_at')->nullable();
                $table->timestamp('twitch_summary_last_scrapped_at')->nullable();
                $table->dateTime('tiktok_last_scrapped_at')->nullable();
            });

            Schema::create('brand_creator', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('creator_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('brand_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->timestamps();
            });

            Schema::create('creator_comments', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('creator_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->longText('comment');
                $table->uuid('deleted_by')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });

            Schema::create('creator_notes', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('creator_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->text('note');
                $table->timestamps();

                $table->index(['user_id', 'creator_id']);
            });

            Schema::create('creator_user_list', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('creator_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('user_list_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->timestamps();
            });

            Schema::create('crms', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('creator_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->dateTime('last_contacted')->nullable();
                $table->double('offer')->nullable();
                $table->boolean('archived')->nullable()->default(false);
                $table->double('rating')->nullable();
                $table->integer('stage')->nullable()->default(0);
                $table->boolean('favourite')->nullable()->default(false);
                $table->boolean('muted')->nullable()->default(false);
                $table->text('meta')->nullable();
                $table->timestamps();
                $table->boolean('selected')->nullable()->default(false);
                $table->boolean('rejected')->nullable()->default(false);
                $table->string('source')->nullable();
            });

            Schema::create('errors', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('user_list_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('type')->default(1);
                $table->string('code')->nullable();
                $table->text('message')->nullable();
                $table->text('meta')->nullable();
                $table->timestamps();
            });

            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->comment('');
                $table->id();
                $table->string('uuid')->index();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });

            Schema::create('imports', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('user_list_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->mediumText('tags')->nullable();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->string('instagram')->nullable();
                $table->string('youtube')->nullable();
                $table->string('twitter')->nullable();
                $table->string('twitch')->nullable();
                $table->string('twitch_id')->nullable()->index();
                $table->string('onlyFans')->nullable();
                $table->string('tiktok')->nullable();
                $table->string('linkedin')->nullable();
                $table->string('snapchat')->nullable();
                $table->string('wikiId')->nullable();
                $table->string('gender')->nullable();
                $table->string('phone')->nullable();
                $table->mediumText('emails')->nullable();
                $table->mediumText('social_handlers')->nullable();
                $table->timestamps();
                $table->boolean('instagram_scrapped')->default(false);
                $table->boolean('youtube_scrapped')->default(false);
                $table->boolean('twitter_scrapped')->default(false);
                $table->boolean('twitch_scrapped')->default(false);
                $table->boolean('onlyFans_scrapped')->default(false);
                $table->boolean('tiktok_scrapped')->default(false);
                $table->boolean('linkedin_scrapped')->default(false);
                $table->boolean('snapchat_scrapped')->default(false);
                $table->boolean('wikiId_scrapped')->default(false);
                $table->boolean('dispatched')->default(false);
                $table->boolean('instagram_dispatched')->default(false);
                $table->boolean('youtube_dispatched')->default(false);
                $table->boolean('twitter_dispatched')->default(false);
                $table->boolean('twitch_dispatched')->default(false);
                $table->boolean('onlyFans_dispatched')->default(false);
                $table->boolean('tiktok_dispatched')->default(false);
                $table->boolean('linkedin_dispatched')->default(false);
                $table->boolean('snapchat_dispatched')->default(false);
                $table->boolean('wikiId_dispatched')->default(false);
            });

            Schema::create('job_batches', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->string('name');
                $table->integer('total_jobs');
                $table->integer('pending_jobs');
                $table->integer('failed_jobs');
                $table->text('failed_job_ids');
                $table->mediumText('options')->nullable();
                $table->integer('cancelled_at')->nullable();
                $table->integer('created_at');
                $table->integer('finished_at')->nullable();
                $table->uuid('user_list_id')->nullable();
                $table->uuid('initial_total_in_file')->nullable();
                $table->string('type')->nullable();
                $table->string('error_code')->nullable();
            });

            Schema::create('jobs', function (Blueprint $table) {
                $table->comment('');
                $table->id();
                $table->string('queue')->index();
                $table->longText('payload');
                $table->unsignedTinyInteger('attempts');
                $table->unsignedInteger('reserved_at')->nullable();
                $table->unsignedInteger('available_at');
                $table->unsignedInteger('created_at');
            });

            Schema::create('notifications', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->nullable();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->integer('type');
                $table->text('message');
                $table->text('meta')->nullable();
                $table->timestamps();
            });

            Schema::create('subscriptions', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('team_id');
                $table->string('name');
                $table->string('stripe_id')->index();
                $table->string('stripe_status');
                $table->string('stripe_price')->nullable();
                $table->integer('quantity')->nullable();
                $table->timestamp('trial_ends_at')->nullable();
                $table->timestamp('ends_at')->nullable();
                $table->timestamps();
                $table->integer('seats')->nullable();
                $table->integer('credits')->nullable();
                $table->double('amount')->nullable();
                $table->string('currency')->nullable();
                $table->string('interval')->nullable();
                $table->integer('type')->default(0);

                $table->index(['team_id', 'stripe_status']);
            });

            Schema::create('subscription_items', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('subscription_id');
                $table->string('stripe_id')->index();
                $table->string('stripe_product');
                $table->string('stripe_price');
                $table->integer('quantity')->nullable();
                $table->timestamps();
                $table->integer('type')->nullable();

                $table->index(['subscription_id', 'stripe_price']);
            });

            Schema::create('testes', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->timestamps();
            });

            Schema::create('user_lists', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->string('name');
                $table->char('emoji')->nullable()->default('?');
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->timestamps();

                $table->index(['user_id', 'name']);
            });

            Schema::create('user_list_attributes', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->uuid('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('team_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->uuid('user_list_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
                $table->integer('order')->default(0);
                $table->boolean('pinned')->default(false);
                $table->timestamps();
            });

            Schema::create('waitlists', function (Blueprint $table) {
                $table->comment('');
                $table->uuid('id')->primary();
                $table->string('email');
                $table->timestamps();
                $table->string('page')->nullable();
            });
        } catch (Exception $exception) {
            dump($exception->getLine());
            dump($exception->getMessage());
            dd(1);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_lists', function (Blueprint $table) {
            $table->dropForeign('user_lists_team_id_foreign');
            $table->dropForeign('user_lists_user_id_foreign');
        });

        Schema::table('user_list_attributes', function (Blueprint $table) {
            $table->dropForeign('user_list_attributes_team_id_foreign');
            $table->dropForeign('user_list_attributes_user_id_foreign');
            $table->dropForeign('user_list_attributes_user_list_id_foreign');
        });

        Schema::table('team_user', function (Blueprint $table) {
            $table->dropForeign('team_user_team_id_foreign');
            $table->dropForeign('team_user_user_id_foreign');
        });

        Schema::table('team_invites', function (Blueprint $table) {
            $table->dropForeign('team_invites_team_id_foreign');
        });

        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('notifications_team_id_foreign');
            $table->dropForeign('notifications_user_id_foreign');
        });

        Schema::table('job_batches', function (Blueprint $table) {
            $table->dropForeign('job_batches_user_list_id_foreign');
        });

        Schema::table('imports', function (Blueprint $table) {
            $table->dropForeign('imports_team_id_foreign');
            $table->dropForeign('imports_user_id_foreign');
            $table->dropForeign('imports_user_list_id_foreign');
        });

        Schema::table('errors', function (Blueprint $table) {
            $table->dropForeign('errors_user_id_foreign');
        });

        Schema::table('crms', function (Blueprint $table) {
            $table->dropForeign('crms_creator_id_foreign');
            $table->dropForeign('crms_team_id_foreign');
            $table->dropForeign('crms_user_id_foreign');
        });

        Schema::table('creators', function (Blueprint $table) {
            $table->dropForeign('creators_user_id_foreign');
        });

        Schema::table('creator_user_list', function (Blueprint $table) {
            $table->dropForeign('creator_user_list_creator_id_foreign');
            $table->dropForeign('creator_user_list_user_list_id_foreign');
        });

        Schema::table('creator_notes', function (Blueprint $table) {
            $table->dropForeign('creator_notes_creator_id_foreign');
            $table->dropForeign('creator_notes_user_id_foreign');
        });

        Schema::table('creator_comments', function (Blueprint $table) {
            $table->dropForeign('creator_comments_creator_id_foreign');
            $table->dropForeign('creator_comments_deleted_by_foreign');
            $table->dropForeign('creator_comments_user_id_foreign');
        });

        Schema::table('brand_creator', function (Blueprint $table) {
            $table->dropForeign('brand_creator_brand_id_foreign');
            $table->dropForeign('brand_creator_creator_id_foreign');
        });

        Schema::dropIfExists('waitlists');

        Schema::dropIfExists('users');

        Schema::dropIfExists('user_lists');

        Schema::dropIfExists('user_list_attributes');

        Schema::dropIfExists('testes');

        Schema::dropIfExists('teams');

        Schema::dropIfExists('team_user');

        Schema::dropIfExists('team_invites');

        Schema::dropIfExists('subscriptions');

        Schema::dropIfExists('subscription_items');

        Schema::dropIfExists('personal_access_tokens');

        Schema::dropIfExists('password_resets');

        Schema::dropIfExists('notifications');

        Schema::dropIfExists('jobs');

        Schema::dropIfExists('job_batches');

        Schema::dropIfExists('imports');

        Schema::dropIfExists('failed_jobs');

        Schema::dropIfExists('errors');

        Schema::dropIfExists('crms');

        Schema::dropIfExists('creators');

        Schema::dropIfExists('creator_user_list');

        Schema::dropIfExists('creator_notes');

        Schema::dropIfExists('creator_comments');

        Schema::dropIfExists('brand_creator');
    }
};
