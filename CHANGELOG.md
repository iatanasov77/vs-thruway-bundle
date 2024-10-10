1.0.1	|	Release date: **10.10.2024**
============================================
* New Features:
  - Change Vorex Namespace to Vankosoft.


1.0.0	|	Release date: **09.10.2024**
============================================
* New Features:
  - Create Bundle


0.1.2	|	Release date: **07.10.2024**
============================================
* Bug-Fixes and Improvements:
  - Litle Fix for WampKernel.
  - Fix Console Commands Services Definitions.
  - Fix ThruwayWorkerCommand .
  - Make ThruwayWorkerCommand and WampKernel Extendable.


0.1.1	|	Release date: **07.10.2024**
============================================
* Bug-Fixes:
  - Fix PSR 4 Namespace in composer.json
  - Fix Depenency Injection Components About to Symfony 6
  - Fix All Commandss to Use Vankosoft ContainerAwareCommand .
  - Fix WampKernel About Symfony 6.


0.1.0	|	Release date: **07.10.2024**
============================================
* New Features:
* Bug-Fixes:
* Commits:
	[2014-08-30 00:27:47 -0400][Commit: c40a669ba07abb9b477e2ae07b4d68ea196fef8a]
	  first commit
	[2014-08-30 11:57:12 -0400][Commit: 5a3f1ad223c5317ee17dcb9f48eec16a3abe23bb]
	  Updated README
	[2014-08-30 12:00:23 -0400][Commit: ac654847a75b9437e13f73e16a6821e072bec08d]
	  Update README.md
	[2014-08-30 15:10:41 -0400][Commit: f79782e8fc184bda0f16215b6613078da3d07fe8]
	  Added logging option to config
	[2014-08-30 19:21:23 -0400][Commit: 20df583d461cdd399fa2e72ec9fad5d277e47519]
	  Added authentication for the in_memory provider
	[2014-08-31 21:45:28 -0400][Commit: b250831c3ed32471bc335e9ca48592ec8725bf85]
	  Added a wrapper and short lived client for publish and call
	[2014-09-17 15:44:34 -0400][Commit: 4572fe9dc79ebcdc3b74ce8821b70f3741475810]
	  Made the in mem provider always available.
	[2014-10-07 17:09:08 -0400][Commit: 1ab64f358f50e912382e9c447809c53a539466d7]
	  Update composer.json
	[2014-10-10 00:10:30 -0400][Commit: a91b6ebee3ea0e36251161c5529bb15fc69b50b2]
	  Subscribe annotation now works
	[2014-10-10 00:14:42 -0400][Commit: 6937b18e8aeafc187f94e6039214113b912f88b1]
	  Added worker option with supervisord A bit of refactoring and clean up
	[2014-10-12 15:06:03 -0400][Commit: 07253f3734b6e5b401a5a09c3af3e6fd0f915a7d]
	  changed discloseCaller to discloser_caller
	[2014-10-16 13:30:40 -0400][Commit: 9c24d508ae6331990155d8b5632b6482e0a810c2]
	  Changed @RPC to @Register
	[2014-10-16 13:33:54 -0400][Commit: c0aa66acc43824ce35f026f84eab144ea39de37a]
	  Allow call to return promise
	[2014-10-16 13:58:50 -0400][Commit: 9a6c7edbebc059fb25b9de5d58dbcc8bb08853f1]
	  Made it so that if a call is registered without multi register, we'll only add it to the first worker
	[2014-10-17 17:30:54 +0000][Commit: 1d28425afd61a0ae929c4ab55036b1069c66b229]
	  Remove dependency from Doctrine ORM
	[2014-10-17 17:35:41 +0000][Commit: 11684d5987af323d3070ec7ffa4599c1588208cf]
	  Add alias for in memory provider only if it exists
	[2014-10-17 13:56:33 -0400][Commit: 7c2f2fd9f04b6f850e189f40261ae852b301a688]
	  Merge pull request #1 from megazoll/remove-orm-dependency
	[2014-10-17 13:56:56 -0400][Commit: c80e58e07c12c0b549afa89adf879d8be052db03]
	  Merge pull request #2 from megazoll/fix-extension
	[2014-10-23 22:37:06 -0400][Commit: 48dd94a9df550f96a377b00eb086b1d51d8f2151]
	  Finished the supervisord feature. Added a Worker Annotation. Lots of other changes and fixes.
	[2014-10-30 00:11:09 +0000][Commit: 9442d79d3e679609a52dc3366658c81532499172]
	  Use path for log dir from kernel in supervisors command
	[2014-10-30 00:28:17 +0000][Commit: 2561db00de087a0994c26ceb5d76dc9a07ca7765]
	  Add option for serializing null in Register annotation
	[2014-10-29 21:54:50 -0400][Commit: c83067bc72d506b52763d823f97adf97964229bb]
	  Merge pull request #3 from megazoll/fix-log-dir
	[2014-10-29 22:09:19 -0400][Commit: d5c34fce521976be3dcbf43a9d2ffeed50362126]
	  Merge pull request #4 from megazoll/allow-serialize-null
	[2014-10-30 19:21:49 -0400][Commit: 0788dfcb6815a8142d9f2c62dec85d4c0d48c394]
	  Changed resource services to use prototype, so each call or event is treated more like a "use once" request/response Moved User info to an injected Trait Lots of other refactoring
	[2014-10-30 20:08:45 -0400][Commit: 5250b60efe2e18ccb5145188454e0da009087340]
	  Refactored Supervisord command
	[2014-11-01 20:55:21 -0400][Commit: 6e604c3adb97c0a5b1b1fed5697c4d94bdc08568]
	  Added some support for @Security Annotation
	[2014-11-03 08:38:57 -0500][Commit: 8684c44d76e6b6ef94297720ef1f464257f0c83a]
	  Removed pawl dev-master - it's now included in Thruway
	[2014-11-07 15:51:27 -0500][Commit: c2c22ec7ce0ae720a7f7e71845fe461096c2f781]
	  Updates for logging
	[2014-11-10 14:15:58 -0500][Commit: 3d779c5a04437c1eb35443f000788528d36507ab]
	  Fix more logging stuff
	[2014-11-12 16:00:36 +0300][Commit: 39791a0bd37ace0e588b14ac91ca9e2beb2da0ef]
	  Fix logfile name in supervisor command
	[2014-11-12 13:50:37 -0500][Commit: db3e559319022c683fee747831ec15256073c274]
	  Merge pull request #6 from megazoll/patch-1
	[2014-11-12 15:03:12 -0500][Commit: 5a951dcab593c493ee8085d9e69510ab3944e3ac]
	  Thruway now deserializes associative arrays as stdClass
	[2014-11-17 11:16:25 -0500][Commit: dbf56175571e833f32f15eeabba2456622ab7328]
	  Interfaces names should end with "Interface"
	[2014-11-17 11:28:20 -0500][Commit: e8c8598c0514f868c43e0d9a4053867aa6573253]
	  Text files should end with a newline character
	[2014-11-17 11:40:42 -0500][Commit: ca2f2162472c13cceec951e859b88660e16f69cf]
	  Fixed unused use statements
	[2014-11-17 11:45:16 -0500][Commit: a08a589f85aa5d56c87c0241b017b71703de73d2]
	  Removed unused options
	[2014-11-17 11:50:40 -0500][Commit: 6e55cec811cfa3131639844f78f1a92e03867955]
	  Removed some unused code and fixed some formatting
	[2014-11-17 11:52:56 -0500][Commit: 1050ed549efeeeff44d6b20d9840aa42ec21d60e]
	  Bumped dependency versions
	[2014-11-17 11:58:46 -0500][Commit: aa759b261731a8652c1f29ccc134fe50fa14b908]
	  Renamed Annotation interface file
	[2014-11-17 15:08:57 -0500][Commit: 1c4683347b794a3cb929d796695cce121e1dd1ef]
	  More Annotation updates
	[2014-11-21 12:00:48 -0500][Commit: 34968c2b1fc7892bd12f42b6173bbaab89d43279]
	  Update README.md
	[2014-11-21 12:25:24 -0500][Commit: 1dfd3e5e1cd4dd6782a8f2b713c65a2eed41c9db]
	  Removed old logger from client command
	[2014-11-21 12:39:06 -0500][Commit: aa7f754fe4211825cf2039dd28332496c7318a3c]
	  Update README.md
	[2014-11-23 22:14:17 +0100][Commit: e75c1009dc2bb0816993e3642fe6f334ea8345d4]
	  Update UserDB.php
	[2014-11-23 23:46:22 +0100][Commit: a06d4f2684126df13bfb0e9c1cc47a8e58120d69]
	  Update README.md
	[2014-12-06 23:59:59 -0500][Commit: ec7f6a8a3f871559fac29cb12607a717115c91e2]
	  Added wamp.open event to kernel.event_listener
	[2014-12-07 00:40:34 -0500][Commit: 1b8ec28c520de81d7508b74acd7b41caeb6d5041]
	  Added process info to SessionEvent
	[2014-12-11 22:11:43 -0500][Commit: 350895b7cd0c98d3c79442f14649d4af2f0322dc]
	  Fixed issue where kernel.controller events were not getting cleaned up for RPCs
	[2014-12-14 16:44:13 -0500][Commit: 162034b656a2065f36f649704c13187a6c5129ce]
	  Can now scan bundles for thruway annotations
	[2014-12-14 18:36:10 -0500][Commit: aaae11b2a5d413b4ea27d1f3af6af1da6065ff07]
	  Updated README and added some sleeps to the supervisord command
	[2014-12-15 15:44:31 -0500][Commit: 96589f2f02b3c253bd04d6f372153e1e925c9372]
	  Added topic state handler annotation option to Register
	[2014-12-15 16:10:19 -0500][Commit: 12cd067f13ab8e3aa524e833759d0dd5d52cc9ef]
	  Updated SessionEvent
	[2014-12-18 14:00:30 -0500][Commit: 0d5137c968f463e66b02daff4a352aaec84dd804]
	  added trusted_uri option back to config
	[2015-01-02 14:07:01 -0500][Commit: 2b0a6ca928f7072920542782ad943f6b44d964ed]
	  Updated topic state handler URI
	[2015-01-02 16:28:40 -0500][Commit: 301670e65f59d16dc6162208d4cec501eac6f295]
	  Added URI to topic state registration
	[2015-01-14 17:42:34 -0500][Commit: 2976447975a1284d83702bd55ef56dcfeed57e48]
	  Merge pull request #7 from moave/master
	[2015-01-19 16:29:45 -0500][Commit: 3ec584597a82ddfbe2e02f499bc04b4eb7fb8a41]
	  Fixed some error handling
	[2015-02-03 11:34:32 +0000][Commit: d1ecb47a384ed5c61a07f7b395e91d6ad5006dd2]
	  Lower the Finder requirement
	[2015-02-06 08:48:08 -0500][Commit: 1e949897197c85f259aea028047dedcf8fda6afe]
	  Merge pull request #8 from Easen/patch-1
	[2015-02-06 09:14:02 -0500][Commit: ba6df7392aba1191d123665368a5ea7a81b03ce8]
	  Disabled controller events And forced cleanup to happen at the start of each subscription and rpc
	[2015-02-08 22:33:25 -0500][Commit: 5c2e387d8e3df2e1f0482ff3ac17402beb1bd913]
	  Added options to state handler to allow things like prefix matching
	[2015-02-08 22:34:15 -0500][Commit: f974007673147f36c3a73fe5bb606d4397cb23fb]
	  Only set user information on controller if there is a valid user.
	[2015-02-20 12:29:57 -0500][Commit: ee7f6a06592b946bf4f441044370639e51256e9d]
	  Update shorted lived client config settings
	[2015-02-24 18:25:09 -0500][Commit: deecad01b588947b51b7128b3f615ab3ca3fb55e]
	  Replaced supervisor with built in process manager
	[2015-02-24 18:44:47 -0500][Commit: d1274047584dde2ba9fb07ce10ca3b2db1f6347e]
	  Update README.md
	[2015-02-24 20:09:00 -0500][Commit: 58a64493a6ebf48721a9065caaa87e06d8c2a051]
	  Added react/child-process to deps
	[2015-03-05 21:00:03 -0500][Commit: 7ba7fa053dd9c627b04374effbcec12d77c0f8b3]
	  Update composer.json
	[2015-03-18 09:39:39 -0400][Commit: d8a1d510346a6b0ed1b8469b01da09643f01eb35]
	  Process commands now return promises
	[2015-03-20 09:14:07 -0400][Commit: 75313d90e2737b8669397c2930cf523c1a34c57d]
	  Update README.md
	[2015-04-03 10:33:28 -0400][Commit: a7df7a25cedc50462825e4d6057071e94670e98c]
	  Improved anonymous user handling
	[2015-04-16 11:31:46 -0400][Commit: 0a3ba9b8c7773357eee91116d047c6a04a8c9378]
	  Authentication no longer relies on the FOS User
	[2015-04-17 12:50:42 -0400][Commit: 0f3707faf92d88cdd0d5ee6999b1c67d74e505f8]
	  Added support for guest workers
	[2015-04-17 12:51:29 -0400][Commit: 818e8abe7273a43f4654f321105ffe0ebc7e2314]
	  Changed uri config options to url
	[2015-04-17 13:23:05 -0400][Commit: feebcf60d36940c82dda3e539da7555365709242]
	  Worker annotation now uses url instead of uri
	[2015-04-17 16:58:47 -0400][Commit: 55b735be830db9e9c01e996014276e5d42e57056]
	  Missed one $uri var
	[2015-04-21 14:20:52 -0400][Commit: acd140f58d63605099bef4db95e8b9b030c08a8a]
	  Added some more doctrine cleanup and better exception messages
	[2015-04-21 16:27:57 -0400][Commit: cfe91c4e88f36912450701044df04c9e27c9f869]
	  Options argument needed fixing for object/array issues
	[2015-05-14 22:33:54 +0500][Commit: 30175a1be623f020c3fbda362fbb5cd2bcd5719b]
	  Typo fixed
	[2015-05-14 13:46:30 -0400][Commit: 87b8d402d1a7bd832f799355aa9a7654fb718a60]
	  Merge pull request #17 from youmad/master
	[2015-05-19 23:23:06 -0400][Commit: d4a76a922327283bac35398433e9a8d5be6639c9]
	  A new service container is now created for each WAMP request
	[2015-05-20 10:55:23 -0400][Commit: 8b7509dc812709e7f6e34329320c37abd36383e3]
	  The thruway client now get passed to the controller container and the `UserAwareTrait` has been deprecated
	[2015-05-20 12:00:58 -0400][Commit: b507a4a4385bfe5f50b06df7ab2544523f44871b]
	  Added thruway.details service for Events and RPCs
	[2015-05-20 14:29:21 -0400][Commit: ec9bc1ccb445425d32c494497663c264706af35b]
	  Defined thruway.details in services.xml
	[2015-05-20 14:30:24 -0400][Commit: 4c07751c9de8494c0f394bd4396b59549c054df5]
	  Moved the congestion manager into the process manager
	[2015-05-20 21:05:31 -0400][Commit: 4d0e621f32897dc76b3eec6518b200a61462b713]
	  Setup proper testing
	[2015-05-20 21:08:16 -0400][Commit: 573b5806117998bb9d8b4daf79ecf282dcf9edda]
	  travis commit
	[2015-05-21 09:39:15 -0400][Commit: 7671fb96ab911e371a721cf9969d0ebbc5342332]
	  Added simple RPC test
	[2015-05-21 13:05:20 -0400][Commit: 8738102479181bf525eaf029386ff9e22fb22a83]
	  WampKernel refactoring
	[2015-05-21 13:28:00 -0400][Commit: 41a0665415ec741cfcb241195a6df6798fc5acc4]
	  removed unused code
	[2015-05-21 16:13:05 -0400][Commit: 34d3f79b55bb31ba496f33b01cfb56b7ab4fb40e]
	  Added a debug command
	[2015-05-21 16:39:19 -0400][Commit: 456a02a98ae9f6ee91f09eeabdf08a9416ca5b2d]
	  Added param info for URI to debug command
	[2015-05-21 18:47:17 -0400][Commit: 0d55f17d0a866f367394a392aa194207d600a9df]
	  uri cannot have upper-case letters
	[2015-05-21 18:52:45 -0400][Commit: e3b455377085cbd110e9fb807bf9a43936cca39d]
	  Merge pull request #18 from tacman/patch-1
	[2015-05-21 18:54:57 -0400][Commit: c7b05d6373daaa9443072cef29bb8c4dab80a6f8]
	  Update README.md
	[2015-05-22 10:56:56 -0400][Commit: 798c6a5256516a9e2ca034061dcb9580e1cc2beb]
	  Updated docs and made `user_provider` optional
	[2015-05-22 10:57:44 -0400][Commit: 9ed8b029f92791f04177a55ff06f81d3a48eb0dd]
	  Added `enable_topic_state` config option
	[2015-05-26 09:34:21 -0400][Commit: 06807f56b69cf5d0e69476a39e0fe784e5be2565]
	  Ensure that doctrine connections get closed out properly
	[2015-06-23 10:01:44 -0400][Commit: 18e675f48b36dbb0b5b96dcee0ab5f6e752e0534]
	  Internal client tag added. AuthorizationManager can be turned on and off.
	[2015-06-23 16:24:52 -0400][Commit: eeb7c1014d7fac548b3c37eb067679f12f6b5427]
	  Grab user_provider from Controller container instead.
	[2015-06-25 15:28:44 -0400][Commit: fe25d7c30c795e2c0167574f8fb6957708547b52]
	  Pass the loop to the inner container
	[2015-08-24 15:04:59 -0400][Commit: 00b2c3b680cba58862fce5ad0b2fff6ad7480853]
	  Now uses Serializer's toArray/fromArray so we don't need to json_encode/decode as much.  Added more tests.
	[2015-08-24 15:19:46 -0400][Commit: 772b023846c1116914d195f8ad36d5b7516cc8ce]
	  Fixed test issue for php7
	[2015-08-28 10:36:26 -0400][Commit: 76c31289773fffdb24d69aa2cc5d2c70d7746930]
	  Removed support for the "Manager" since it's been removed from Thruway
	[2015-08-29 16:07:16 -0400][Commit: cbac26410abe2f9fcd81e14c98956c6d86517297]
	  if no authid is available set the user to "anonymous"
	[2015-08-29 19:35:03 -0400][Commit: 2786cdecbbb596aa7f775525c049075e1fe900be]
	  Make sure we pass an array to serializer and don't set anonymous is no authid is provided
	[2015-08-30 21:52:57 +0200][Commit: a272b19cec4897c84956c55a31f8507260dd8a2e]
	  Add Authorization Manager
	[2015-08-30 22:06:12 +0200][Commit: 2881ffe9257cb1a02b63bb65196210c80f2cb8eb]
	  Update doc with Authorization Manager
	[2015-09-15 10:19:27 -0400][Commit: 6a6fd4b2a8df8f7e495d16a9d9eb3f4d4abf1b31]
	  Refactored ClientManager
	[2015-09-15 11:15:34 -0400][Commit: 752b8a01a167b8c4492b1244102bc75179659f52]
	  Serialization null checks
	[2015-10-29 10:48:44 +0100][Commit: cae858504c2b0805422f923c0e4fd6d119ae8e4d]
	  Update WampKernel.php
	[2015-10-30 15:16:53 -0400][Commit: e65a8ecd6bba69d274b5a76a560daceeb519b83b]
	  Added `thruway.global` tag
	[2015-10-30 15:53:46 -0400][Commit: a5fbec0f5fe65a048f57955c3f9124eb73109c4d]
	  Merge pull request #27 from TNAJanssen/patch-1
	[2015-10-30 16:28:38 -0400][Commit: 74821dbc72fa72f3c1742527cada8ddbbe11dcb9]
	  Updated and added some tests
	[2015-12-02 08:35:44 -0500][Commit: 62e6aa3806e3363da6bee851cf2fdf18e0bdeb2d]
	  Merge pull request #26 from AchilleAsh/master
	[2015-12-04 11:55:25 -0500][Commit: be87b4d2a87b02a23794a4f001d00acfa2c0a29a]
	  Output command exceptions to the console
	[2016-02-03 16:21:59 -0500][Commit: 3099d49ef406ef5b054a6ff4f37468002e3b5dcc]
	  Symfony 3 compatibility.  Fixes #32
	[2016-03-30 14:31:21 -0400][Commit: 6f657be02aadc03c52d89e5b81c4088766966b01]
	  Improved process manager error handling A bit of cleanup
	[2016-07-07 08:15:16 -0700][Commit: aa9ae3a537137df88a7f7deb74daadb0fee418d3]
	  made service `voryx.thruway.wamp.cra.auth.client` public
	[2016-07-07 08:16:03 -0700][Commit: abd9b4c93e0768711e212eb7f60e92317089711e]
	  Merge branch 'master' of git://github.com/voryx/ThruwayBundle
	[2016-09-03 13:44:08 -0500][Commit: ee4926b1863bfe0211fa7598bdd6003d82568163]
	  Setup with FOSUserBundle 1.3 or latest
	[2016-09-05 14:19:06 -0400][Commit: f614b36b8061fc03a8f809869c135ae7b12e6443]
	  Merge pull request #43 from saidmoya12/patch-1
	[2016-12-09 10:59:14 -0800][Commit: d1403f59f9690c57713bae22ae87d3b301611506]
	  Changed `serializer` service to `jms_serializer`. Fixes #50
	[2017-02-24 14:21:10 -0500][Commit: 55f10fd46a4d018f3d072e8e7a6bd92b6568aa64]
	  Use syntax for Symfony 2.6+
	[2017-02-24 14:27:55 -0500][Commit: 1b1fceee1b8f824b17919b23c9f019074055832d]
	  Merge pull request #53 from tacman/patch-2
	[2017-03-01 09:32:04 -0500][Commit: 31bf63deef6f5266a542360a16aea222a722b985]
	  Fix error message
	[2017-03-01 09:33:31 -0500][Commit: 1ca7e426dfddc7e212e7153ae8707de20f964583]
	  Merge pull request #54 from tacman/patch-3
	[2017-03-08 17:10:55 -0500][Commit: 84cacc6d066265c4d85f190aa31452a2b7cefa20]
	  use "exec" command in ThruwayProcessCommand to avoid extra processes; add --no-exec option to turn it off
	[2017-03-08 18:20:16 -0500][Commit: a6310da7d9981648abf1141b7ef245ee0b4709ba]
	  Merge pull request #58 from survos/add-no-exec-option
	[2017-03-10 15:06:44 -0500][Commit: a0de46f647bd0ea62651c247ef53d4abe152c337]
	  Replaced JMS serializer with Symfony serializer
	[2017-03-13 20:17:44 +0200][Commit: 5ab3849d58fd0c38ddf313aac6e586b552182026]
	  Symfony serializer works in RPC calls
	[2017-03-13 14:34:15 -0400][Commit: ddc2380f20a6820cde95c34b2ddb5b926c3b2eab]
	  Merge pull request #59 from karser/symfony_serializer
	[2017-04-10 15:44:54 +0300][Commit: f3451c6ce2136e81aa59fbd5e4bfb71348351610]
	  Authorization Manager Thruway v.4 Compatibility Updates (#33)
	[2017-04-10 15:44:54 +0300][Commit: bc97ccee5b4f7249e770e1fcec6130fbf8dd6026]
	  Authorization Manager Thruway v.4 Compatibility Updates (#33)
	[2017-06-06 15:20:50 -0400][Commit: cf8a7901c92372f3b06dc64def8a6050d81edb63]
	  Update composer.json
	[2017-06-06 15:22:36 -0400][Commit: 3c7bb7743a72064a3e3df8a0bcd0798693731d82]
	  Update composer.json
	[2017-06-06 15:26:49 -0400][Commit: 93636825674bc572e18099c00e6282641b6027fe]
	  Update composer.json
	[2017-06-16 06:45:52 -0400][Commit: 3ad8389f59110227147730b586eaaa0a33a72056]
	  Fix markup
	[2017-06-16 08:22:01 -0400][Commit: 4d107691d891d5c5e4726ac85aed0da186f1f37a]
	  Merge pull request #64 from tacman/patch-3
	[2017-11-20 15:45:37 -0500][Commit: fdc25b3b0c382d8ce17e2dc2deaf2ecf90339566]
	  Merge branch 'symfony_serializer'
	[2017-11-20 15:47:09 -0500][Commit: b05f8af2ccc7a5cd26cc3d4bfa8904ea3212fa61]
	  Updated composer for symfony serializer
	[2017-11-20 15:49:41 -0500][Commit: d9a6f460e647262b6045c9c348bb3a788ebe2e3c]
	  Removed unused WebPushClient
	[2017-11-20 16:09:33 -0500][Commit: 5a1a457ea34f023a01b73194fb0612a55c5f8bd2]
	  Updated formatting and docblocks
	[2017-11-20 16:19:06 -0500][Commit: 794e6ff958c68a0c7ec603d3a6f0ce4877debac3]
	  Update php versions in travis
	[2017-11-20 16:30:16 -0500][Commit: bf56c9ece61d7b40370a4b6f1f3db2b70db38d04]
	  Update serializer versions
	[2017-11-20 16:32:56 -0500][Commit: 305b1e9f8ee15d69867213dc27fa9f9f531324f8]
	  Updated finder versions
	[2017-11-20 17:04:10 -0500][Commit: 386dfbc74d9cb313288523da244e59e7cd4ff1b6]
	  Updated Thruway to v 0.5.0 Set minimum symfony deps to 2.7
	[2017-11-26 17:44:11 -0500][Commit: 9eb3c3a1807c54e7f4873829f2032209cbf609a7]
	  use correct normalize args with promises
	[2017-11-26 19:32:30 -0500][Commit: 1ed197e4cb2a8c64e9d2ac21c500c1089a4d51da]
	  Added serialization tests Added support for stdClass
	[2017-12-02 17:00:59 +0100][Commit: ebab621f8aafacdf6f81e6900373202d33bd4f1f]
	  Add escapeshellarg to PHP_BINARY
	[2017-12-02 17:00:59 +0100][Commit: 177a20e9ced2e4c8a9e564d283d35c8d9aece17b]
	  Add escapeshellarg to PHP_BINARY
	[2018-01-01 12:02:44 -0500][Commit: 22bc084dcbd579727e838071fec244d49b4ee1b1]
	  Update README.md
	[2018-01-01 12:02:44 -0500][Commit: 9b3222d88d06144552e8b08a06585d4c36d8852b]
	  Update README.md
	[2018-01-01 12:53:21 -0500][Commit: ae18561485ee55651a2a27d9f78aa943985c6cd3]
	  Update composer.json
	[2018-01-01 12:53:21 -0500][Commit: 6bd9d14948cce434d2d85ad7603819f352ec7b35]
	  Update composer.json
	[2018-01-02 14:53:17 -0500][Commit: 4ed1b90c9ee5f16a52f5c78430f7cd0cf02e7cc4]
	  Merge pull request #70 from valepu/patch-2
	[2018-01-02 14:53:17 -0500][Commit: b389e6db90c7eb56b6d897c3a6966676cfeed91f]
	  Merge pull request #70 from valepu/patch-2
	[2018-01-02 14:54:16 -0500][Commit: a8c4cf9b1ac1c066103742151c96564d3f5c64d3]
	  Update composer.json
	[2018-01-02 14:54:16 -0500][Commit: 1271254df5f5ed97f90294a47cd0952e021a7b7c]
	  Update composer.json
	[2018-02-19 11:12:12 +0100][Commit: c4ca077c71a03d18ebc150783c028f25f8d7cf3f]
	  Add support for Symfony 4 (Symfony 2.7 is still supported)
	[2018-02-19 11:29:08 +0100][Commit: 1cc69d7c98b6598e7952b03f5c0b00a43e028a0b]
	  Call setLogger for Thruway command services
	[2018-02-19 11:35:10 +0100][Commit: 425999998672c5fb1840fcb0d6d41d1172560e46]
	  Disable autowiring and use DI setter configuration for Logger
	[2018-02-19 12:03:43 +0100][Commit: ad071c298350d1c0cfa0d67cb6ffc889340ae76f]
	  Fix Logger::set initialization. Using Logger::set in VoryxThruwayExtension will configure the Logger only when DI is compiling services. Use the 'enable_logging' parameter in commands.
	[2018-02-19 15:11:21 +0100][Commit: ad9c0940c43b10e9905d63c631150f4e17682662]
	  Update README.md to give some hint with Symfony 4
	[2018-02-20 11:22:38 +0100][Commit: 35ff14cb44b56b23592967385c6ea33e9567a6d1]
	  Update dependencies constraints
	[2018-02-20 14:53:48 +0100][Commit: 9be04c072b9f082383d91aa909511a43334ac94a]
	  Make logger calls PSR compliant.
	[2018-02-20 14:54:17 +0100][Commit: 61d65ac831a40bf461b03ac9a4f5fe7b3ba9a28d]
	  Update dependencies
	[2018-02-20 14:54:54 +0100][Commit: 5d0eceec5245e3a251d12d35e4e6cfff62b847b6]
	  Update README.md and make services work with Symfony 4.
	[2018-02-21 16:12:07 -0500][Commit: 6de1c3df2c178940fb2a1c479c820fa5e23b6944]
	  Merge pull request #77 from roissard/master
	[2018-02-21 18:03:31 -0500][Commit: f77e2e843360dc5af9db022a142759c9d217df87]
	  Automattically scan for annotated workers in the src/Controller folder
	[2018-02-21 19:04:37 -0500][Commit: 9777bfb558846a8fca901e119af55955481ff64c]
	  Added a symfony 4 quick start guide
	[2018-02-21 19:12:20 -0500][Commit: a6523376b9e44a520d6edbed0ef8b48ea09f0c31]
	  Update README.md
	[2018-02-28 16:03:46 +0000][Commit: dc37850198e2a365556ee127004a2ce5b9548054]
	  Create a configurable match option for the Subscribe annotation.
	[2018-03-04 14:05:13 +0200][Commit: 1d9e7e1af0b0917fc3963168e7df1acb5ad52e9a]
	  Replace echo with command output
	[2018-03-06 17:46:59 +0000][Commit: d2f3c7f91727f2bec77a4c7c63d1523bdbed5de7]
	  Remove the default match argument.
	[2018-03-06 17:48:21 +0000][Commit: 0c53d3310338b1bde1ffe3370bba317d09f7ee30]
	  Only set the match option if it's defined.
	[2018-03-09 15:05:12 -0500][Commit: 38418cfac04766a2d2f52dc00c72b0d7986c79bc]
	  Merge pull request #79 from ThePixelDeveloper/feature/configurable-matcher
	[2018-03-09 15:05:39 -0500][Commit: f3591c9e1c2dfdd9b4779b9f98118cccca271882]
	  Merge pull request #80 from stingus/master
	[2018-11-26 12:43:13 -0500][Commit: 4c100faf605aa03b09dc56ff45216c7ad32cd2e1]
	  Use definition if it's already been added to the container, so we can use autowire
	[2018-11-26 13:11:38 -0500][Commit: 57b27c0d55a044918e3272053e8b7c080c9ab571]
	  You no longer need to pass $this to the bundle
	[2018-11-26 13:29:43 -0500][Commit: 6a4c710581fddf9cb50162e81e066c90cdae1647]
	  Use hasDefinition instead of getDefinition
	[2018-11-26 13:46:23 -0500][Commit: a064781063d14a41decdaea31fbfc1ee0c0e32ed]
	  Added better error reporting for WampKernel RPC
	[2018-11-26 14:00:09 -0500][Commit: a003394dd668b3895f41b62d9319be65b491d52e]
	  Fix test for more detailed error message
	[2018-11-27 12:49:05 -0500][Commit: 509280ba6d4cd4df13fc6715e503737bfa09dd21]
	  Copy container build_id, build_hash, build_time from parent container. Fixes #87
	[2018-11-28 10:55:34 -0500][Commit: a3bbb715031751f2db11d371675eddc79b8808bf]
	  Set container build params in constructor
	[2018-12-26 17:41:46 +0500][Commit: 13fe2df322bfbe8d763c20c37ddf4da15a7d78f1]
	  Add public alias to security.user.provider.concrete.in_memory service
	[2018-12-28 11:02:25 -0500][Commit: 228439bf9ba477b27e1068f1b4b7b037eb3921e4]
	  Merge pull request #91 from youmad/master
	[2019-07-04 11:04:29 -0400][Commit: d5b5fc0406222d1a527c7bf4850a270a7bab7d1d]
	  Socket Connector as a Service
	[2019-07-04 20:24:03 -0400][Commit: 2b80bafc36b6c57e97b78c31d47e4b9c9e2c9aa4]
	  Updated pawl-transport version
	[2019-07-11 17:51:59 -0400][Commit: 15b9b0612cdc30f08c8c852fd19eeaeabdd865eb]
	  Use the react connector service in the worker command
	[2019-07-18 16:28:08 -0400][Commit: 0197958c090797072d2b8061784cc60163276f32]
	  Use a new container on each RPC
	[2024-10-07 04:56:57 +0000][Commit: 3522722180afa1d204b71f4e28c01c35e14e1ae1]
	  Update composer.json to support Symfony6 and PHP8.
	[2024-10-07 04:59:38 +0000][Commit: 419c769573c04aea66d9a47bb9c34a8946f08117]
	  Update composer.json to support Symfony6 and PHP8.

