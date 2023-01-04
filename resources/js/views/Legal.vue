<template>
  <TabGroup
    vertical
    :defaultIndex="defaultTab"
    as="div"
    class="flex w-full flex-row">
    <div class="fixed top-0 flex h-full w-60 flex-col">
      <TabList class="mt-24 flex flex-col space-y-2 px-4">
        <Tab
          as="template"
          v-for="tab in tabs"
          :key="tab.name"
          v-slot="{ selected }">
          <button
            :class="[
              selected
                ? 'bg-slate-100 text-slate-700 dark:bg-jovieDark-700 dark:text-jovieDark-300'
                : 'border-transparent text-slate-900 dark:text-jovieDark-100',
              'flex-1 whitespace-nowrap rounded-md py-1 px-1 text-left text-xs font-medium  outline-none ring-0 focus:outline-none focus:ring-0',
            ]">
            {{ tab.name }}
          </button>
        </Tab>
      </TabList>
    </div>
    <main class="flex h-full w-full dark:bg-jovieDark-900">
      <div class="relative mx-auto max-w-7xl md:px-8 xl:px-0">
        <div class="pb-16">
          <div class="px-4 sm:px-6 md:px-0">
            <div class="pb-6">
              <!-- Tabs -->

              <div
                class="overflow-auto border-b border-slate-200 dark:border-jovieDark-border"></div>

              <TabPanels as="template">
                <TabPanel
                  class="prose mx-auto max-w-5xl space-y-12 overflow-auto px-4 py-6">
                  <div class="prose overflow-y-scroll">
                    <article>

      <div data-custom-class="body">
      <div><strong><span style="font-size: 26px;">
        <span data-custom-class="title">PRIVACY NOTICE</span>
        </span></strong></div><div><br></div><div>
          <span style="color: rgb(127, 127, 127);"><strong>
            <span style="font-size: 15px;"><span data-custom-class="subtitle">Last updated <bdt class="question">January 03, 2023</bdt>
            </span></span></strong></span></div><div><br></div><div><br></div><div><br></div><div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text">This privacy notice for <bdt class="question">Jovie Inc<bdt class="block-component"></bdt>
            </bdt> (<bdt class="block-component"></bdt>"<bdt class="block-component"></bdt><strong>Company</strong><bdt class="statement-end-if-in-editor"></bdt>," "<strong>we</strong>," "<strong>us</strong>," or "<strong>our</strong>"<bdt class="statement-end-if-in-editor"></bdt></span><span data-custom-class="body_text">), describes how and why we might collect, store, use, and/or share (<bdt class="block-component"></bdt>"<strong>process</strong>"<bdt class="statement-end-if-in-editor"></bdt>) your information when you use our services (<bdt class="block-component"></bdt>"<strong>Services</strong>"<bdt class="statement-end-if-in-editor"></bdt>), such as when you:</span></span></span><span style="font-size: 15px;"><span style="color: rgb(127, 127, 127);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>
            </span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Visit our website<bdt class="block-component"></bdt> at <bdt class="question"><a href="https://jov.ie" target="_blank" data-custom-class="link">https://jov.ie</a></bdt>
            <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor">, or any website of ours that links to this privacy notice</bdt></span></span></span></span></span></span></span></span></li></ul><div><bdt class="block-component"><span style="font-size: 15px;"><span style="font-size: 15px;"><span style="color: rgb(127, 127, 127);">
              <span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></bdt>
              <div style="line-height: 1.5;"><span style="font-size: 15px;"><span style="color: rgb(127, 127, 127);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><ul>
                <li style="line-height: 1.5;">
                  <span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Engage with us in other related ways, including any sales, marketing, or events<span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);">
                    <bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px;"><span style="color: rgb(127, 127, 127);"><span data-custom-class="body_text">
                      <strong>Questions or concerns?&nbsp;</strong>Reading this privacy notice will help you understand your privacy rights and choices. If you do not agree with our policies and practices, please do not use our Services. If you still have any questions or concerns, please contact us at <bdt class="question">support@jov.ie</bdt>.</span></span></span></div>
                      <div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><strong><span style="font-size: 15px;"><span data-custom-class="heading_1">SUMMARY OF KEY POINTS</span>
                      </span></strong></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong><em>This summary provides key points from our privacy notice, but you can find out more details about any of these topics by clicking the link following each key point or by using our table of contents below to find the section you are looking for. You can also click&nbsp;</em></strong></span></span><a data-custom-class="link" href="#toc"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong><em>here</em></strong></span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text"><strong><em>&nbsp;to go directly to our table of contents.</em></strong></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>What personal information do we process?</strong> When you visit, use, or navigate our Services, we may process personal information depending on how you interact with <bdt class="block-component"></bdt><bdt class="question">Jovie Inc</bdt><bdt class="statement-end-if-in-editor"></bdt> and the Services, the choices you make, and the products and features you use. Click&nbsp;</span></span><a data-custom-class="link" href="#personalinfo"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span>
                      </span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;">
                        <span style="font-size: 15px;"><span data-custom-class="body_text"><strong>Do we process any sensitive personal information?</strong> <bdt class="block-component"></bdt>We do not process sensitive personal information.<bdt class="else-block"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">
                          <strong>Do we receive any information from third parties?</strong> <bdt class="block-component"></bdt>We may receive information from public databases, marketing partners, social media platforms, and other outside sources. Click&nbsp;</span></span><a data-custom-class="link" href="#othersources"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.<bdt class="statement-end-if-in-editor"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>How do we process your information?</strong> We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply with law. We may also process your information for other purposes with your consent. We process your information only when we have a valid legal reason to do so. Click&nbsp;</span></span><a data-custom-class="link" href="#infouse"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>In what situations and with which <bdt class="block-component"></bdt>parties do we share personal information?</strong> We may share information in specific situations and with specific <bdt class="block-component"></bdt>third parties. Click&nbsp;</span></span><a data-custom-class="link" href="#whoshare"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.<bdt class="block-component"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>How do we keep your information safe?</strong> We have <bdt class="block-component"></bdt>organizational<bdt class="statement-end-if-in-editor"></bdt> and technical processes and procedures in place to protect your personal information. However, no electronic transmission over the internet or information storage technology can be guaranteed to be 100% secure, so we cannot promise or guarantee that hackers, cybercriminals, or other <bdt class="block-component"></bdt>unauthorized<bdt class="statement-end-if-in-editor"></bdt> third parties will not be able to defeat our security and improperly collect, access, steal, or modify your information. Click&nbsp;</span></span><a data-custom-class="link" href="#infosafe"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.<bdt class="statement-end-if-in-editor"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>What are your rights?</strong> Depending on where you are located geographically, the applicable privacy law may mean you have certain rights regarding your personal information. Click&nbsp;</span></span><a data-custom-class="link" href="#privacyrights"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>How do you exercise your rights?</strong> The easiest way to exercise your rights is by filling out our data subject request form available <bdt class="block-component"></bdt>here: <bdt class="question"><a href="https://jov.ie/terms" target="_blank" data-custom-class="link">https://jov.ie/terms</a></bdt><bdt class="else-block"></bdt>, or by contacting us. We will consider and act upon any request in accordance with applicable data protection laws.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">Want to learn more about what <bdt class="block-component"></bdt><bdt class="question">Jovie Inc</bdt><bdt class="statement-end-if-in-editor"></bdt> does with any information we collect? Click&nbsp;</span></span><a data-custom-class="link" href="#toc"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to review the notice in full.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><br></div><div id="toc" style="line-height: 1.5;"><span style="font-size: 15px;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">TABLE OF CONTENTS</span></strong></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#infocollect"><span style="color: rgb(89, 89, 89);">1. WHAT INFORMATION DO WE COLLECT?</span></a></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#infouse"><span style="color: rgb(89, 89, 89);">2. HOW DO WE PROCESS YOUR INFORMATION?<bdt class="block-component"></bdt></span></a></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#legalbases"><span style="color: rgb(89, 89, 89);">3. <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);">WHAT LEGAL BASES DO WE RELY ON TO PROCESS YOUR PERSONAL INFORMATION?</span></span><bdt class="statement-end-if-in-editor"></bdt></span></a></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><a data-custom-class="link" href="#whoshare">4. WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?</a></span><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a href="#3pwebsites"><span data-custom-class="link">5. WHAT IS OUR STANCE ON THIRD-PARTY WEBSITES?<bdt class="statement-end-if-in-editor"></bdt></span></a><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#cookies"><span style="color: rgb(89, 89, 89);">6. DO WE USE COOKIES AND OTHER TRACKING TECHNOLOGIES?</span></a><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span></span><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#sociallogins"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);">7. HOW DO WE HANDLE YOUR SOCIAL LOGINS?</span></span></span></a><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span></span><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#inforetain"><span style="color: rgb(89, 89, 89);">8. HOW LONG DO WE KEEP YOUR INFORMATION?</span></a><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><bdt class="block-component"></bdt></span></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#infosafe"><span style="color: rgb(89, 89, 89);">9. HOW DO WE KEEP YOUR INFORMATION SAFE?</span></a><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><a data-custom-class="link" href="#privacyrights">10. WHAT ARE YOUR PRIVACY RIGHTS?</a></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#DNT"><span style="color: rgb(89, 89, 89);">11. CONTROLS FOR DO-NOT-TRACK FEATURES</span></a></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#caresidents"><span style="color: rgb(89, 89, 89);">12. DO CALIFORNIA RESIDENTS HAVE SPECIFIC PRIVACY RIGHTS?</span></a></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><a data-custom-class="link" href="#policyupdates"><span style="color: rgb(89, 89, 89);">13. DO WE MAKE UPDATES TO THIS NOTICE?</span></a></span></div><div style="line-height: 1.5;"><a data-custom-class="link" href="#contact"><span style="color: rgb(89, 89, 89); font-size: 15px;">14. HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</span></a></div><div style="line-height: 1.5;"><a data-custom-class="link" href="#request"><span style="color: rgb(89, 89, 89);">15. HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?</span></a></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><br></div><div id="infocollect" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">1. WHAT INFORMATION DO WE COLLECT?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="personalinfo" style="line-height: 1.5;"><span data-custom-class="heading_2" style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><strong>Personal information you disclose to us</strong></span></span></div><div><div><br></div><div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:</em></strong></span></span></span></span><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>&nbsp;</em></strong><em>We collect personal information that you provide to us.</em></span></span></span></span></span></span></div></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We collect personal information that you voluntarily provide to us when you <span style="font-size: 15px;"><bdt class="block-component"></bdt></span>register on the Services,&nbsp;</span><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="statement-end-if-in-editor"></bdt></span></span><span data-custom-class="body_text">express an interest in obtaining information about us or our products and Services, when you participate in activities on the Services, or otherwise when you contact us.</span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Personal Information Provided by You.</strong> The personal information that we collect depends on the context of your interactions with us and the Services, the choices you make, and the products and features you use. The personal information we collect may include the following:<span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">names</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">phone numbers</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">email addresses</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">mailing addresses</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">job titles</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">usernames</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">passwords</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">contact preferences</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">contact or authentication data</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">billing addresses</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">debit/credit card numbers</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">social media usernames</bdt></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></div><div id="sensitiveinfo" style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>Sensitive Information.</strong> <bdt class="block-component"></bdt>We do not process sensitive information.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="else-block"></bdt></span></span><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Payment Data.</strong> We may collect data necessary to process your payment if you make purchases, such as your payment instrument number, and the security code associated with your payment instrument. All payment data is stored by<bdt class="forloop-component"></bdt><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span> <bdt class="question">Stripe</bdt><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></span>. You may find their privacy notice link(s) here:<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="forloop-component"></bdt><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span> <bdt class="question"><a href="https://stripe.com/privacy" target="_blank" data-custom-class="link">https://stripe.com/privacy</a></bdt><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span><bdt class="forloop-component"></bdt><span style="font-size: 15px;"><span data-custom-class="body_text">.<bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">__________</bdt><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"><bdt class="block-component"></bdt></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Social Media Login Data.&nbsp;</strong>We may provide you with the option to register with us using your existing social media account details, like your Facebook, Twitter, or other social media account. If you choose to register in this way, we will collect the information described in the section called <bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><a data-custom-class="link" href="#sociallogins">HOW DO WE HANDLE YOUR SOCIAL LOGINS?</a></span></span></span></span><bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt> below.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="statement-end-if-in-editor"><bdt class="statement-end-if-in-editor"></bdt></bdt></span></span></span></span><bdt class="block-component"></bdt></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">All personal information that you provide to us must be true, complete, and accurate, and you must notify us of any changes to such personal information.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><span data-custom-class="heading_2" style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><strong>Information automatically collected</strong></span></span></div><div><div><br></div><div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:</em></strong></span></span></span></span><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>&nbsp;</em></strong><em>Some information — such as your Internet Protocol (IP) address and/or browser and device characteristics — is collected automatically when you visit our Services.</em></span></span></span></span></span></span></div></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We automatically collect certain information when you visit, use, or navigate the Services. This information does not reveal your specific identity (like your name or contact information) but may include device and usage information, such as your IP address, browser and device characteristics, operating system, language preferences, referring URLs, device name, country, location, information about how and when you use our Services, and other technical information. This information is primarily needed to maintain the security and operation of our Services, and for our internal analytics and reporting purposes.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Like many businesses, we also collect information through cookies and similar technologies. <bdt class="block-component"></bdt><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt></span><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">The information we collect includes:<bdt class="block-component"></bdt></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><em>Log and Usage Data.</em> Log and usage data is service-related, diagnostic, usage, and performance information our servers automatically collect when you access or use our Services and which we record in log files. Depending on how you interact with us, this log data may include your IP address, device information, browser type, and settings and information about your activity in the Services<span style="font-size: 15px;">&nbsp;</span>(such as the date/time stamps associated with your usage, pages and files viewed, searches, and other actions you take such as which features you use), device event information (such as system activity, error reports (sometimes called <bdt class="block-component"></bdt>"crash dumps"<bdt class="statement-end-if-in-editor"></bdt>), and hardware settings).<span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><em>Device Data.</em> We collect device data such as information about your computer, phone, tablet, or other device you use to access the Services. Depending on the device used, this device data may include information such as your IP address (or proxy server), device and application identification numbers, location, browser type, hardware model, Internet service provider and/or mobile carrier, operating system, and system configuration information.<span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><em>Location Data.</em> We collect location data such as information about your device's location, which can be either precise or imprecise. How much information we collect depends on the type and settings of the device you use to access the Services. For example, we may use GPS and other technologies to collect geolocation data that tells us your current location (based on your IP address). You can opt out of allowing us to collect this information either by refusing access to the information or by disabling your Location setting on your device. However, if you choose to opt out, you may not be able to use certain aspects of the Services.<span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></li></ul><div><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><bdt class="statement-end-if-in-editor"></bdt><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"><bdt class="block-component"></bdt></bdt></span></span></span></span></span></div><div id="othersources" style="line-height: 1.5;"><span data-custom-class="heading_2" style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><strong>Information collected from other sources</strong></span></span></div><div><div><br></div><div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:&nbsp;</em></strong><em>We may collect limited data from public databases, marketing partners, <span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><em><span data-custom-class="body_text"><bdt class="block-component"></bdt>social media platforms, <bdt class="statement-end-if-in-editor"></bdt></span></em></span></span>and other outside sources.</em></span></span></span></span></span></span></div></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">In order to enhance our ability to provide relevant marketing, offers, and services to you and update our records, we may obtain information about you from other sources, such as public databases, joint marketing partners, affiliate programs, data providers,<span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt> social media platforms,<bdt class="statement-end-if-in-editor"></bdt></span></span>&nbsp;</span>and from other third parties. This information includes mailing addresses, job titles, email addresses, phone numbers, intent data (or user <bdt class="block-component"></bdt>behavior<bdt class="statement-end-if-in-editor"></bdt> data), Internet Protocol (IP) addresses, social media profiles, social media URLs, and custom profiles, for purposes of targeted advertising and event promotion.<span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span>&nbsp;</span>If you interact with us on a social media platform using your social media account (e.g.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> Facebook or Twitter), we receive personal information about you such as your name, email address, and gender. Any personal information that we collect from your social media account depends on your social media account's privacy settings.</span></span></span></span><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><bdt class="block-component"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"><bdt class="statement-end-if-in-editor"></bdt></bdt></span></span></span></span></bdt></span></span></span></span></span></span></span></span><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></div><div id="infouse" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">2. HOW DO WE PROCESS YOUR INFORMATION?</span></strong></span></span></span></span></span></div><div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:&nbsp;</em></strong><em>We process your information to provide, improve, and administer our Services, communicate with you, for security and fraud prevention, and to comply with law. We may also process your information for other purposes with your consent.</em></span></span></span></span></span></span></div></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>We process your personal information for a variety of reasons, depending on how you interact with our Services, including:</strong><bdt class="block-component"></bdt></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>To facilitate account creation and authentication and otherwise manage user accounts.&nbsp;</strong>We may process your information so you can create and log in to your account, as well as keep your account in working order.<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><p style="font-size: 15px; line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt></p><p style="font-size: 15px; line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt></p><p style="font-size: 15px; line-height: 1.5;"><bdt class="block-component"></bdt></p><p style="font-size: 15px; line-height: 1.5;"><bdt class="block-component"></bdt></p><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"></span></bdt><div style="line-height: 1.5;"><span style="font-size: 15px;"><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></span><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><strong>To save or protect an individual's vital interest.</strong> We may process your information when necessary to save or protect an individual’s vital interest, such as to prevent harm.</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><div style="line-height: 1.5;"><br></div><div id="legalbases" style="line-height: 1.5;"><strong><span style="font-size: 15px;"><span data-custom-class="heading_1">3. WHAT LEGAL BASES DO WE RELY ON TO PROCESS YOUR INFORMATION?</span></span></strong></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><em><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>In Short:&nbsp;</strong>We only process your personal information when we believe it is necessary and we have a valid legal reason (i.e.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> legal basis) to do so under applicable law, like with your consent, to comply with laws, to provide you with services to enter into or <bdt class="block-component"></bdt>fulfill<bdt class="statement-end-if-in-editor"></bdt> our contractual obligations, to protect your rights, or to <bdt class="block-component"></bdt>fulfill<bdt class="statement-end-if-in-editor"></bdt> our legitimate business interests.</span></span></em><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><em><span style="font-size: 15px;"><span data-custom-class="body_text"><strong><u>If you are located in the EU or UK, this section applies to you.</u></strong></span></span></em><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">The General Data Protection Regulation (GDPR) and UK GDPR require us to explain the valid legal bases we rely on in order to process your personal information. As such, we may rely on the following legal bases to process your personal information:</span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>Consent.&nbsp;</strong>We may process your information if you have given us permission (i.e.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> consent) to use your personal information for a specific purpose. You can withdraw your consent at any time. Click&nbsp;</span></span><a data-custom-class="link" href="#withdrawconsent"><span style="font-size: 15px;"><span data-custom-class="body_text">here</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text">&nbsp;to learn more.</span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><strong>Legal Obligations.</strong> We may process your information where we believe it is necessary for compliance with our legal obligations, such as to cooperate with a law enforcement body or regulatory agency, exercise or defend our legal rights, or disclose your information as evidence in litigation in which we are involved.<bdt class="statement-end-if-in-editor"></bdt><br></span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><strong>Vital Interests.</strong> We may process your information where we believe it is necessary to protect your vital interests or the vital interests of a third party, such as situations involving potential threats to the safety of any person.</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><strong><u><em>If you are located in Canada, this section applies to you.</em></u></strong><bdt class="statement-end-if-in-editor"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">We may process your information if you have given us specific permission (i.e.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> express consent) to use your personal information for a specific purpose, or in situations where your permission can be inferred (i.e.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> implied consent). You can withdraw your consent at any time. Click&nbsp;</span></span><a data-custom-class="link" href="#withdrawconsent"><span data-custom-class="body_text"><span style="font-size: 15px;">here</span></span></a><span data-custom-class="body_text"><span style="font-size: 15px;">&nbsp;to learn more.</span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">In some exceptional cases, we may be legally permitted under applicable law to process your information without your consent, including, for example:</span></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If collection is clearly in the interests of an individual and consent cannot be obtained in a timely way</span></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">For investigations and fraud detection and prevention<bdt class="statement-end-if-in-editor"></bdt></span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">For business transactions provided certain conditions are met</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If it is contained in a witness statement and the collection is necessary to assess, process, or settle an insurance claim</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">For identifying injured, ill, or deceased persons and communicating with next of kin</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If we have reasonable grounds to believe an individual has been, is, or may be victim of financial abuse<bdt class="statement-end-if-in-editor"></bdt></span></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If it is reasonable to expect collection and use with consent would compromise the availability or the accuracy of the information and the collection is reasonable for purposes related to investigating a breach of an agreement or a contravention of the laws of Canada or a province<bdt class="statement-end-if-in-editor"></bdt></span></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If disclosure is required to comply with a subpoena, warrant, court order, or rules of the court relating to the production of records<bdt class="statement-end-if-in-editor"></bdt></span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">If it was produced by an individual in the course of their employment, business, or profession and the collection is consistent with the purposes for which the information was produced<bdt class="statement-end-if-in-editor"></bdt></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">If the collection is solely for journalistic, artistic, or literary purposes<bdt class="statement-end-if-in-editor"></bdt></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">If the information is publicly available and is specified by the regulations</span><bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt></span></li></ul><div style="line-height: 1.5;"><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><div style="line-height: 1.5;"><br></div><div id="whoshare" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">4. WHEN AND WITH WHOM DO WE SHARE YOUR PERSONAL INFORMATION?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:</em></strong><em>&nbsp;We may share information in specific situations described in this section and/or with the following <bdt class="block-component"></bdt>third parties.</em></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">We <bdt class="block-component"></bdt>may need to share your personal information in the following situations:</span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>Business Transfers.</strong> We may share or transfer your information in connection with, or during negotiations of, any merger, sale of company assets, financing, or acquisition of all or a portion of our business to another company.</span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span><div style="line-height: 1.5;"><span style="font-size: 15px;"><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong>Affiliates.&nbsp;</strong>We may share your information with our affiliates, in which case we will require those affiliates to <bdt class="block-component"></bdt>honor<bdt class="statement-end-if-in-editor"></bdt> this privacy notice. Affiliates include our parent company and any subsidiaries, joint venture partners, or other companies that we control or that are under common control with us.</span><bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><strong>Business Partners.</strong> We may share your information with our business partners to offer you certain products, services, or promotions.</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><div style="line-height: 1.5;"><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><strong><span id="3pwebsites" style="font-size: 15px;"><span data-custom-class="heading_1">5. WHAT IS OUR STANCE ON THIRD-PARTY WEBSITES?</span></span></strong></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong><em>In Short:</em></strong><em>&nbsp;We are not responsible for the safety of any information that you share with third parties that we may link to or who advertise on our Services, but are not affiliated with, our Services.</em></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">The Services<bdt class="block-component"></bdt> may link to third-party websites, online services, or mobile applications and/or contain advertisements from third parties that are not affiliated with us and which may link to other websites, services, or applications. Accordingly, we do not make any guarantee regarding any such third parties, and we will not be liable for any loss or damage caused by the use of such third-party websites, services, or applications. The inclusion of a link towards a third-party website, service, or application does not imply an endorsement by us. We cannot guarantee the safety and privacy of data you provide to any third parties. Any data collected by third parties is not covered by this privacy notice. We are not responsible for the content or privacy and security practices and policies of any third parties, including other websites, services, or applications that may be linked to or from the Services. You should review the policies of such third parties and contact them directly to respond to your questions.</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="block-component"><span data-custom-class="heading_1"></span></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="cookies" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">6. DO WE USE COOKIES AND OTHER TRACKING TECHNOLOGIES?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:</em></strong><em>&nbsp;We may use cookies and other tracking technologies to collect and store your information.</em></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We may use cookies and similar tracking technologies (like web beacons and pixels) to access or store information. Specific information about how we use such technologies and how you can refuse certain cookies is set out in our Cookie Notice<span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt>.</span><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="sociallogins" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">7. HOW DO WE HANDLE YOUR SOCIAL LOGINS?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:&nbsp;</em></strong><em>If you choose to register or log in to our Services using a social media account, we may have access to certain information about you.</em></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Our Services offer you the ability to register and log in using your third-party social media account details (like your Facebook or Twitter logins). Where you choose to do this, we will receive certain profile information about you from your social media provider. The profile information we receive may vary depending on the social media provider concerned, but will often include your name, email address, friends list, and profile picture, as well as other information you choose to make public on such a social media platform. <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We will use the information we receive only for the purposes that are described in this privacy notice or that are otherwise made clear to you on the relevant Services. Please note that we do not control, and are not responsible for, other uses of your personal information by your third-party social media provider. We recommend that you review their privacy notice to understand how they collect, use, and share your personal information, and how you can set your privacy preferences on their sites and apps.<span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span><bdt class="block-component"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></bdt></span></span></span></span></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="inforetain" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">8. HOW LONG DO WE KEEP YOUR INFORMATION?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:&nbsp;</em></strong><em>We keep your information for as long as necessary to <bdt class="block-component"></bdt>fulfill<bdt class="statement-end-if-in-editor"></bdt> the purposes outlined in this privacy notice unless otherwise required by law.</em></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We will only keep your personal information for as long as it is necessary for the purposes set out in this privacy notice, unless a longer retention period is required or permitted by law (such as tax, accounting, or other legal requirements).<bdt class="block-component"></bdt> No purpose in this notice will require us keeping your personal information for longer than <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span><bdt class="block-component"></bdt>the period of time in which users have an account with us<bdt class="block-component"></bdt><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="else-block"></bdt></span></span></span>.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">When we have no ongoing legitimate business need to process your personal information, we will either delete or <bdt class="block-component"></bdt>anonymize<bdt class="statement-end-if-in-editor"></bdt> such information, or, if this is not possible (for example, because your personal information has been stored in backup archives), then we will securely store your personal information and isolate it from any further processing until deletion is possible.<span style="color: rgb(89, 89, 89);"><bdt class="block-component"></bdt></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="infosafe" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">9. HOW DO WE KEEP YOUR INFORMATION SAFE?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:&nbsp;</em></strong><em>We aim to protect your personal information through a system of <bdt class="block-component"></bdt>organizational<bdt class="statement-end-if-in-editor"></bdt> and technical security measures.</em></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We have implemented appropriate and reasonable technical and <bdt class="block-component"></bdt>organizational<bdt class="statement-end-if-in-editor"></bdt> security measures designed to protect the security of any personal information we process. However, despite our safeguards and efforts to secure your information, no electronic transmission over the Internet or information storage technology can be guaranteed to be 100% secure, so we cannot promise or guarantee that hackers, cybercriminals, or other <bdt class="block-component"></bdt>unauthorized<bdt class="statement-end-if-in-editor"></bdt> third parties will not be able to defeat our security and improperly collect, access, steal, or modify your information. Although we will do our best to protect your personal information, transmission of personal information to and from our Services is at your own risk. You should only access the Services within a secure environment.<span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="privacyrights" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">10. WHAT ARE YOUR PRIVACY RIGHTS?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:</em></strong><em>&nbsp;<span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><em><bdt class="block-component"></bdt></em></span></span></span>In some regions, such as <bdt class="block-component"></bdt>the European Economic Area (EEA), United Kingdom (UK), and Canada<bdt class="block-component"></bdt>, you have rights that allow you greater access to and control over your personal information.<span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><em><bdt class="statement-end-if-in-editor"></bdt></em></span></span>&nbsp;</span>You may review, change, or terminate your account at any time.</em><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">In some regions (like <bdt class="block-component"></bdt>the EEA, UK, and Canada<bdt class="block-component"></bdt>), you have certain rights under applicable data protection laws. These may include the right (i) to request access and obtain a copy of your personal information, (ii) to request rectification or erasure; (iii) to restrict the processing of your personal information; and (iv) if applicable, to data portability. In certain circumstances, you may also have the right to object to the processing of your personal information. You can make such a request by contacting us by using the contact details provided in the section <bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt></span></span></span><a data-custom-class="link" href="#contact"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</span></span></span></a><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt> below.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We will consider and act upon any request in accordance with applicable data protection laws.</span><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);">&nbsp;</span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">If you are located in the EEA or UK and you believe we are unlawfully processing your personal information, you also have the right to complain to your local data protection supervisory authority. You can find their contact details here: <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(48, 48, 241);"><span data-custom-class="body_text"><a data-custom-class="link" href="https://ec.europa.eu/justice/data-protection/bodies/authorities/index_en.htm" rel="noopener noreferrer" target="_blank"><span style="font-size: 15px;">https://ec.europa.eu/justice/data-protection/bodies/authorities/index_en.htm</span></a></span></span></span></span></span>.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">If you are located in Switzerland, the contact details for the data protection authorities are available here: <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(48, 48, 241);"><span data-custom-class="body_text"><span style="font-size: 15px;"><a data-custom-class="link" href="https://www.edoeb.admin.ch/edoeb/en/home.html" rel="noopener noreferrer" target="_blank">https://www.edoeb.admin.ch/edoeb/en/home.html</a></span></span></span></span></span></span>.</span></span></span></div><div style="line-height: 1.5;"><br></div><div id="withdrawconsent" style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><u>Withdrawing your consent:</u></strong> If we are relying on your consent to process your personal information,<bdt class="block-component"></bdt> which may be express and/or implied consent depending on the applicable law,<bdt class="statement-end-if-in-editor"></bdt> you have the right to withdraw your consent at any time. You can withdraw your consent at any time by contacting us by using the contact details provided in the section <bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt></span></span></span><a data-custom-class="link" href="#contact"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</span></span></span></a><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt> below<bdt class="block-component"></bdt> or updating your preferences<bdt class="statement-end-if-in-editor"></bdt>.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">However, please note that this will not affect the lawfulness of the processing before its withdrawal nor,<bdt class="block-component"></bdt> when applicable law allows,<bdt class="statement-end-if-in-editor"></bdt> will it affect the processing of your personal information conducted in reliance on lawful processing grounds other than consent.<bdt class="block-component"></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><strong><u>Opting out of marketing and promotional communications:</u></strong><strong><u>&nbsp;</u></strong>You can unsubscribe from our marketing and promotional communications at any time by<bdt class="block-component"></bdt> clicking on the unsubscribe link in the emails that we send,<bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt> replying <bdt class="block-component"></bdt>"STOP" or "UNSUBSCRIBE"<bdt class="statement-end-if-in-editor"></bdt> to the SMS messages that we send,<bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt> or by contacting us using the details provided in the section <bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt></span></span><a data-custom-class="link" href="#contact"><span style="font-size: 15px;"><span data-custom-class="body_text">HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</span></span></a><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt>"<bdt class="statement-end-if-in-editor"></bdt> below. You will then be removed from the marketing lists. However, we may still communicate with you — for example, to send you service-related messages that are necessary for the administration and use of your account, to respond to service requests, or for other non-marketing purposes.</span><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="heading_2"><strong>Account Information</strong></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If you would at any time like to review or change the information in your account or terminate your account, you can:<bdt class="forloop-component"></bdt></span></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="question">Log in to your account settings and update your user account.</bdt></span></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;"><bdt class="forloop-component"></bdt></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text">Upon your request to terminate your account, we will deactivate or delete your account and information from our active databases. However, we may retain some information in our files to prevent fraud, troubleshoot problems, assist with any investigations, enforce our legal terms and/or comply with applicable legal requirements.</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><u>Cookies and similar technologies:</u></strong> Most Web browsers are set to accept cookies by default. If you prefer, you can usually choose to set your browser to remove cookies and to reject cookies. If you choose to remove cookies or reject cookies, this could affect certain features or services of our Services. To opt out of interest-based advertising by advertisers on our Services visit <span style="color: rgb(48, 48, 241);"><span data-custom-class="body_text"><a data-custom-class="link" href="http://www.aboutads.info/choices/" rel="noopener noreferrer" target="_blank"><span style="font-size: 15px;">http://www.aboutads.info/choices/</span></a></span></span>. <span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="body_text"><span style="font-size: 15px;">If you have questions or comments about your privacy rights, you may email us at <bdt class="question">support@jov.ie</bdt>.</span></span><bdt class="statement-end-if-in-editor"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt></div><div style="line-height: 1.5;"><br></div><div id="DNT" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">11. CONTROLS FOR DO-NOT-TRACK FEATURES</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Most web browsers and some mobile operating systems and mobile applications include a Do-Not-Track (<bdt class="block-component"></bdt>"DNT"<bdt class="statement-end-if-in-editor"></bdt>) feature or setting you can activate to signal your privacy preference not to have data about your online browsing activities monitored and collected. At this stage no uniform technology standard for <bdt class="block-component"></bdt>recognizing<bdt class="statement-end-if-in-editor"></bdt> and implementing DNT signals has been <bdt class="block-component"></bdt>finalized<bdt class="statement-end-if-in-editor"></bdt>. As such, we do not currently respond to DNT browser signals or any other mechanism that automatically communicates your choice not to be tracked online. If a standard for online tracking is adopted that we must follow in the future, we will inform you about that practice in a revised version of this privacy notice.</span></span></span></div><div style="line-height: 1.5;"><br></div><div id="caresidents" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">12. DO CALIFORNIA RESIDENTS HAVE SPECIFIC PRIVACY RIGHTS?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong><em>In Short:&nbsp;</em></strong><em>Yes, if you are a resident of California, you are granted specific rights regarding access to your personal information.</em></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">California Civil Code Section 1798.83, also known as the <bdt class="block-component"></bdt>"Shine The Light"<bdt class="statement-end-if-in-editor"></bdt> law, permits our users who are California residents to request and obtain from us, once a year and free of charge, information about categories of personal information (if any) we disclosed to third parties for direct marketing purposes and the names and addresses of all third parties with which we shared personal information in the immediately preceding calendar year. If you are a California resident and would like to make such a request, please submit your request in writing to us using the contact information provided below.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">If you are under 18 years of age, reside in California, and have a registered account with Services, you have the right to request removal of unwanted data that you publicly post on the Services. To request removal of such data, please contact us using the contact information provided below and include the email address associated with your account and a statement that you reside in California. We will make sure the data is not publicly displayed on the Services, but please be aware that the data may not be completely or comprehensively removed from all our systems (e.g.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> backups, etc.).<span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="heading_2" style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><strong>CCPA Privacy Notice</strong></span></span></div><div><div><br></div><div style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">The California Code of Regulations defines a <bdt class="block-component"></bdt>"resident"<bdt class="statement-end-if-in-editor"></bdt> as:</span></span></span></span></span></span></div></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5; margin-left: 20px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">(1) every individual who is in the State of California for other than a temporary or transitory purpose and</span></span></span></div><div style="line-height: 1.5; margin-left: 20px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">(2) every individual who is domiciled in the State of California who is outside the State of California for a temporary or transitory purpose</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">All other individuals are defined as <bdt class="block-component"></bdt>"non-residents."<bdt class="statement-end-if-in-editor"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">If this definition of <bdt class="block-component"></bdt>"resident"<bdt class="statement-end-if-in-editor"></bdt> applies to you, we must adhere to certain rights and obligations regarding your personal information.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>What categories of personal information do we collect?</strong></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We have collected the following categories of personal information in the past twelve (12) months:<span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><table style="width: 100%;"><tbody><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Category</strong></span></span></span></td><td style="width: 51.4385%; border-top: 1px solid black; border-right: 1px solid black;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Examples</strong></span></span></span></td><td style="width: 14.9084%; border-right: 1px solid black; border-top: 1px solid black; text-align: center;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Collected</strong></span></span></span></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">A. Identifiers</span></span></span></div></td><td style="width: 51.4385%; border-top: 1px solid black; border-right: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Contact details, such as real name, alias, postal address, telephone or mobile contact number, unique personal identifier, online identifier, Internet Protocol address, email address, and account name</span></span></span></div></td><td style="width: 14.9084%; text-align: center; vertical-align: middle; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">B. Personal information categories listed in the California Customer Records statute</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Name, contact information, education, employment, employment history, and financial information</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">C. Protected classification characteristics under California or federal law</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Gender and date of birth</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">D. Commercial information</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Transaction information, purchase history, financial details, and payment information</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">E. Biometric information</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Fingerprints and voiceprints</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">F. Internet or other similar network activity</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Browsing history, search history, online <bdt class="block-component"></bdt>behavior<bdt class="statement-end-if-in-editor"></bdt>, interest data, and interactions with our and other websites, applications, systems, and advertisements</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">G. Geolocation data</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Device location</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">H. Audio, electronic, visual, thermal, olfactory, or similar information</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Images and audio, video or call recordings created in connection with our business activities</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>YES<bdt class="else-block"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="width: 33.8274%; border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">I. Professional or employment-related information</span></span></span></div></td><td style="width: 51.4385%; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Business contact details in order to provide you our Services at a business level or job title, work history, and professional qualifications if you apply for a job with us</span></span></span></div></td><td style="width: 14.9084%; text-align: center; border-right: 1px solid black; border-top: 1px solid black;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>NO<bdt class="statement-end-if-in-editor"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black; width: 33.8274%;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">J. Education Information</span></span></span></div></td><td style="border-right: 1px solid black; border-top: 1px solid black; width: 51.4385%;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Student records and directory information</span></span></span></div></td><td style="text-align: center; border-right: 1px solid black; border-top: 1px solid black; width: 14.9084%;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>NO<bdt class="statement-end-if-in-editor"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="border-width: 1px; border-color: black; border-style: solid; width: 33.8274%;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">K. Inferences drawn from other personal information</span></span></span></div></td><td style="border-bottom: 1px solid black; border-top: 1px solid black; border-right: 1px solid black; width: 51.4385%;"><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Inferences drawn from any of the collected personal information listed above to create a profile or summary about, for example, an individual’s preferences and characteristics</span></span></span></div></td><td style="text-align: center; border-right: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black; width: 14.9084%;"><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>NO<bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div></td></tr><tr><td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;"><span data-custom-class="body_text">L. Sensitive Personal Information</span></td><td style="border-right: 1px solid black; border-bottom: 1px solid black; line-height: 1.5;"><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></td><td data-custom-class="body_text" style="border-right: 1px solid black; border-bottom: 1px solid black; text-align: center; line-height: 1.5;"><br><bdt class="block-component"><span data-custom-class="body_text"></span></bdt>NO<bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt><br><br></td></tr></tbody></table><div style="line-height: 1.5;"><bdt class="block-component"></bdt></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><bdt class="block-component"><span data-custom-class="body_text"></span></bdt><span data-custom-class="body_text">We will use and retain the collected personal information as needed to provide the Services or for:<bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category A - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category B - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category C - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category D - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category E - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category F - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category G - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">Category H - <bdt class="question">As long as the user has an account with us</bdt><bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span><div style="line-height: 1.5;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span><bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We may also collect other personal information outside of these categories through instances where you interact with us in person, online, or by phone or mail in the context of:<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Receiving help through our customer support channels;</span><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Participation in customer surveys or contests; and</span><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Facilitation in the delivery of our Services and to respond to your inquiries.</span><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>How do we use and share your personal information?</strong></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">More information about our data collection and sharing practices can be found in this privacy notice<bdt class="block-component"></bdt>.</span></span></span></span><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">You may contact us <span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span>by email at&nbsp;</span><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">support@jov.ie</bdt>, <bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt></span><span data-custom-class="body_text"><bdt class="block-component"></bdt><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></span></span></span></span><span data-custom-class="body_text">or by referring to the contact details at the bottom of this document.</span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">If you are using an <bdt class="block-component"></bdt>authorized<bdt class="statement-end-if-in-editor"></bdt> agent to exercise your right to opt out we may deny a request if the <bdt class="block-component"></bdt>authorized<bdt class="statement-end-if-in-editor"></bdt> agent does not submit proof that they have been validly <bdt class="block-component"></bdt>authorized<bdt class="statement-end-if-in-editor"></bdt> to act on your behalf.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Will your information be shared with anyone else?</strong></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We may disclose your personal information with our service providers pursuant to a written contract between us and each service provider. Each service provider is a for-profit entity that processes the information on our behalf, following the same strict privacy protection obligations mandated by the CCPA.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We may use your personal information for our own business purposes, such as for undertaking internal research for technological development and demonstration. This is not considered to be <bdt class="block-component"></bdt>"selling"<bdt class="statement-end-if-in-editor"></bdt> of your personal information.<span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="question">Jovie Inc</bdt></span><span data-custom-class="body_text">&nbsp;has not disclosed, sold, or shared any personal information to third parties for a business or commercial purpose in the preceding twelve (12) months. <span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="question">Jovie Inc</bdt></span></span>&nbsp;</span>will not sell or share personal information in the future belonging to website visitors, users, and other consumers.<span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span><bdt class="block-component"></bdt></span></span></span></span></span><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><strong>Your rights with respect to your personal data</strong></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><u>Right to request deletion of the data — Request to delete</u></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">You can ask for the deletion of your personal information. If you ask us to delete your personal information, we will respect your request and delete your personal information, subject to certain exceptions provided by law, such as (but not limited to) the exercise by another consumer of his or her right to free speech, our compliance requirements resulting from a legal obligation, or any processing that may be required to protect against illegal activities.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><u>Right to be informed — Request to know</u></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Depending on the circumstances, you have a right to know:<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">whether we collect and use your personal information;<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">the categories of personal information that we collect;<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">the purposes for which the collected personal information is used;<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">whether we sell or share personal information to third parties;<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">the categories of personal information that we sold, shared, or disclosed for a business purpose;<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">the categories of third parties to whom the personal information was sold, shared, or disclosed for a business purpose;<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">the business or commercial purpose for collecting, selling, or sharing personal information; and<span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></div><ul><li style="line-height: 1.5;"><span data-custom-class="body_text">the specific pieces of personal information we collected about you.<bdt class="statement-end-if-in-editor"></bdt></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">In accordance with applicable law, we are not obligated to provide or delete consumer information that is de-identified in response to a consumer request or to re-identify individual data to verify a consumer request.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><u>Right to Non-Discrimination for the Exercise of a Consumer’s Privacy Rights</u></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We will not discriminate against you if you exercise your privacy rights.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><u><span data-custom-class="body_text">Right to Limit Use and Disclosure of Sensitive Personal Information</span></u></div><div style="line-height: 1.5;"><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span data-custom-class="body_text">We do not process consumer's sensitive personal information.</span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><bdt class="statement-end-if-in-editor"><span data-custom-class="body_text"></span></bdt></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><u>Verification process</u></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">Upon receiving your request, we will need to verify your identity to determine you are the same person about whom we have the information in our system. These verification efforts require us to ask you to provide information so that we can match it with information you have previously provided us. For instance, depending on the type of request you submit, we may ask you to provide certain information so that we can match the information you provide with the information we already have on file, or we may contact you through a communication method (e.g.<bdt class="block-component"></bdt>,<bdt class="statement-end-if-in-editor"></bdt> phone or email) that you have previously provided to us. We may also use other verification methods as the circumstances dictate.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We will only use personal information provided in your request to verify your identity or authority to make the request. To the extent possible, we will avoid requesting additional information from you for the purposes of verification. However, if we cannot verify your identity from the information already maintained by us, we may request that you provide additional information for the purposes of verifying your identity and for security or fraud-prevention purposes. We will delete such additionally provided information as soon as we finish verifying you.</span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><u>Other privacy rights</u></span></span></span></div><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">You may object to the processing of your personal information.<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">You may request correction of your personal data if it is incorrect or no longer relevant, or ask to restrict the processing of the information.<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">You can designate an <bdt class="block-component"></bdt>authorized<bdt class="statement-end-if-in-editor"></bdt> agent to make a request under the CCPA on your behalf. We may deny a request from an <bdt class="block-component"></bdt>authorized<bdt class="statement-end-if-in-editor"></bdt> agent that does not submit proof that they have been validly <bdt class="block-component"></bdt>authorized<bdt class="statement-end-if-in-editor"></bdt> to act on your behalf in accordance with the CCPA.<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></span></span></span></span></span></span></div><ul><li style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">You may request to opt out from future selling or sharing of your personal information to third parties. Upon receiving an opt-out request, we will act upon the request as soon as feasibly possible, but no later than fifteen (15) days from the date of the request submission.<span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(0, 0, 0);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></span></span></span></li></ul><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">To exercise these rights, you can contact us&nbsp;</span><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt>by email at <bdt class="question">support@jov.ie</bdt>, <bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt></span><span data-custom-class="body_text"><bdt class="block-component"></bdt><bdt class="block-component"><span data-custom-class="body_text"></span></bdt></span></span></span></span></span></span><span data-custom-class="body_text">or by referring to the contact details at the bottom of this document. If you have a complaint about how we handle your data, we would like to hear from you.</span><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"><bdt class="block-component"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"><bdt class="statement-end-if-in-editor"></bdt></bdt></span></span></span></span></span></span></span></span></span></span></bdt></bdt></span></span></div><div style="line-height: 1.5;"><br></div><div id="policyupdates" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">13. DO WE MAKE UPDATES TO THIS NOTICE?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><em><strong>In Short:&nbsp;</strong>Yes, we will update this notice as necessary to stay compliant with relevant laws.</em></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">We may update this privacy notice from time to time. The updated version will be indicated by an updated <bdt class="block-component"></bdt>"Revised"<bdt class="statement-end-if-in-editor"></bdt> date and the updated version will be effective as soon as it is accessible. If we make material changes to this privacy notice, we may notify you either by prominently posting a notice of such changes or by directly sending you a notification. We encourage you to review this privacy notice frequently to be informed of how we are protecting your information.</span></span></span></div><div style="line-height: 1.5;"><br></div><div id="contact" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">14. HOW CAN YOU CONTACT US ABOUT THIS NOTICE?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">If you have questions or comments about this notice, you may <span style="color: rgb(89, 89, 89); font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"></bdt>email us at <bdt class="question">support@jov.ie</bdt><bdt class="statement-end-if-in-editor"></bdt></span></span><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text">&nbsp;or by post to:</span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><span style="font-size: 15px;"><span style="color: rgb(89, 89, 89);"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="question">Jovie Inc</bdt></span></span></span></span></span><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt></span></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">1600 Vine St</bdt><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><bdt class="block-component"></bdt></span></span></span></span></div><div style="line-height: 1.5;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="question">Los Angeles</bdt><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><bdt class="block-component"></bdt><bdt class="block-component"></bdt>, <bdt class="question">CA</bdt><bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt><bdt class="block-component"></bdt> <bdt class="question">90028</bdt><bdt class="statement-end-if-in-editor"></bdt><bdt class="block-component"></bdt><bdt class="block-component"></bdt><bdt class="block-component"></bdt></span></span></span></span></div><div style="line-height: 1.5;"><span data-custom-class="body_text" style="font-size: 15px;"><bdt class="question">United States<span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><bdt class="statement-end-if-in-editor"></bdt></span></span></span></span></span></span></span></span></span></bdt></span><bdt class="block-component"><span style="font-size: 15px;"><span data-custom-class="body_text"></span></span></bdt><bdt class="statement-end-if-in-editor"></bdt><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><bdt class="statement-end-if-in-editor"></bdt></span></span></span><span data-custom-class="body_text"><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89);"><bdt class="statement-end-if-in-editor"><span style="color: rgb(89, 89, 89);"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="block-component"><bdt class="block-component"></bdt></bdt></span></span></span></bdt></span></span></span><span style="font-size: 15px;"><span data-custom-class="body_text"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px;"><span data-custom-class="body_text"><bdt class="statement-end-if-in-editor"><bdt class="block-component"></bdt></bdt></span></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div id="request" style="line-height: 1.5;"><span style="color: rgb(127, 127, 127);"><span style="color: rgb(89, 89, 89); font-size: 15px;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span id="control" style="color: rgb(0, 0, 0);"><strong><span data-custom-class="heading_1">15. HOW CAN YOU REVIEW, UPDATE, OR DELETE THE DATA WE COLLECT FROM YOU?</span></strong></span></span></span></span></span></div><div style="line-height: 1.5;"><br></div><div style="line-height: 1.5;"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span style="font-size: 15px; color: rgb(89, 89, 89);"><span data-custom-class="body_text"><bdt class="block-component"></bdt>Based on the applicable laws of your country, you may have the right to request access to the personal information we collect from you, change that information, or delete it. <bdt class="else-block"></bdt>To request to review, update, or delete your personal information, please <bdt class="block-component"></bdt></span><span data-custom-class="body_text">visit: <bdt class="question"><a href="https://jov.ie/terms" target="_blank" data-custom-class="link">https://jov.ie/terms</a></bdt><bdt class="else-block"></bdt></span></span><span data-custom-class="body_text">.</span></span></div><style>
      ul {
        list-style-type: square;
      }
      ul > li > ul {
        list-style-type: circle;
      }
      ul > li > ul > li > ul {
        list-style-type: square;
      }
      ol li {
        font-family: Arial ;
      }
    </style>
      </div>
      </div>
    </div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></div></article>
                  </div>
                </TabPanel>
              </TabPanels>
              <TabPanels as="template">
                <TabPanel class="prose space-y-12 overflow-y-scroll px-4 py-6">
                  <div class="prose overflow-y-scroll">
                    <div>
                      <div>
                        <div>
                          <div>
                            <div>
                              <div>
                                <div>
                                  <div>
                                    <div>
                                      <div>
                                        <div>
                                          <div>
                                            <div>
                                              <div>
                                                <div data-custom-class="body">
                                                  <div>
                                                    <h1
                                                      class="prose"
                                                      data-custom-class="title">
                                                      <a
                                                        name="_gm5sejt4p02f"></a
                                                      ><strong
                                                        >TERMS OF
                                                        SERVICE</strong
                                                      >
                                                    </h1>
                                                    <div>
                                                      <a
                                                        name="_7m5b3xg56u7y"></a>
                                                    </div>
                                                    <div
                                                      data-custom-class="subtitle">
                                                      <strong
                                                        >Last updated</strong
                                                      ><strong
                                                        >January 03,
                                                        2023</strong
                                                      >
                                                    </div>
                                                    <div
                                                      data-custom-class="subtitle">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <strong
                                                      >TABLE OF CONTENTS</strong
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#agreement"
                                                      data-custom-class="link"
                                                      >1. AGREEMENT TO TERMS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#ip"
                                                      data-custom-class="link"
                                                      >2. INTELLECTUAL PROPERTY
                                                      RIGHTS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#userreps"
                                                      data-custom-class="link"
                                                      >3. USER
                                                      REPRESENTATIONS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#userreg"
                                                      data-custom-class="link"
                                                      >4. USER REGISTRATION</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#payment"
                                                      data-custom-class="link"
                                                      >5. FEES AND PAYMENT</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#cancel"
                                                      data-custom-class="link"
                                                      >6. CANCELLATION</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#software"
                                                      data-custom-class="link"
                                                      >7. SOFTWARE</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#prohibited"
                                                      data-custom-class="link"
                                                      >8. PROHIBITED
                                                      ACTIVITIES</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#ugc"
                                                      data-custom-class="link"
                                                      >9. USER GENERATED
                                                      CONTRIBUTIONS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#license"
                                                      data-custom-class="link"
                                                      >10. CONTRIBUTION
                                                      LICENSE</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#mobile"
                                                      data-custom-class="link"
                                                      >11. MOBILE APPLICATION
                                                      LICENSE</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#socialmedia"
                                                      data-custom-class="link"
                                                      >12. SOCIAL MEDIA</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#submissions"
                                                      data-custom-class="link"
                                                      >13. SUBMISSIONS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#thirdparty"
                                                      data-custom-class="link"
                                                      >14. THIRD-PARTY WEBSITES
                                                      AND CONTENT</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#usrights"
                                                      data-custom-class="link"
                                                      >15. U.S. GOVERNMENT
                                                      RIGHTS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#sitemanage"
                                                      data-custom-class="link"
                                                      >16. SITE MANAGEMENT</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#privacypolicy1"
                                                      data-custom-class="link"
                                                      >17. PRIVACY POLICY</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#copyright1"
                                                      data-custom-class="link"
                                                      >18. COPYRIGHT
                                                      INFRINGEMENTS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#terms"
                                                      data-custom-class="link"
                                                      >19. TERM AND
                                                      TERMINATION</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#modifications"
                                                      data-custom-class="link"
                                                      >20. MODIFICATIONS AND
                                                      INTERRUPTIONS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#law"
                                                      data-custom-class="link"
                                                      >21. GOVERNING LAW</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#disputes"
                                                      data-custom-class="link"
                                                      >22. DISPUTE RESOLUTION</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#corrections"
                                                      data-custom-class="link"
                                                      >23. CORRECTIONS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#disclaimer"
                                                      data-custom-class="link"
                                                      >24. DISCLAIMER</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#liability"
                                                      data-custom-class="link"
                                                      >25. LIMITATIONS OF
                                                      LIABILITY</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#indemnification"
                                                      data-custom-class="link"
                                                      >26. INDEMNIFICATION</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#userdata"
                                                      data-custom-class="link"
                                                      >27. USER DATA</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#electronic"
                                                      data-custom-class="link"
                                                      >28. ELECTRONIC
                                                      COMMUNICATIONS,
                                                      TRANSACTIONS, AND
                                                      SIGNATURES</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#california"
                                                      data-custom-class="link"
                                                      >29. CALIFORNIA USERS AND
                                                      RESIDENTS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#misc"
                                                      data-custom-class="link"
                                                      >30. MISCELLANEOUS</a
                                                    >
                                                  </div>
                                                  <div>
                                                    <a
                                                      href="#contact"
                                                      data-custom-class="link"
                                                      >31. CONTACT US</a
                                                    >
                                                  </div>
                                                  <div>&nbsp;</div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_6aa3gkhykvst"></a
                                                      ><strong
                                                        >1. AGREEMENT TO
                                                        TERMS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      These Terms of Service
                                                      constitute a legally
                                                      binding agreement made
                                                      between you, whether
                                                      personally or on behalf of
                                                      an entity
                                                      (&ldquo;you&rdquo;) and
                                                      Jovie
                                                      Inc&nbsp;("<strong>Company</strong>",
                                                      &ldquo;<strong>we</strong>&rdquo;,
                                                      &ldquo;<strong>us</strong>&rdquo;,
                                                      or
                                                      &ldquo;<strong>our</strong>&rdquo;),
                                                      concerning your access to
                                                      and use of the
                                                      <a
                                                        href="https://jov.ie"
                                                        target="_blank"
                                                        data-custom-class="link"
                                                        >https://jov.ie</a
                                                      >
                                                      website as well as any
                                                      other media form, media
                                                      channel, mobile website or
                                                      mobile application
                                                      related, linked, or
                                                      otherwise connected
                                                      thereto (collectively, the
                                                      &ldquo;Site&rdquo;).&nbsp;We
                                                      are registered in
                                                      Delaware, United
                                                      States&nbsp;and have our
                                                      registered office at 251
                                                      Little Falls Dr,
                                                      Wilmington, DE 19808. You
                                                      agree that by accessing
                                                      the Site, you have read,
                                                      understood, and agree to
                                                      be bound by all of these
                                                      Terms of Service. IF YOU
                                                      DO NOT AGREE WITH ALL OF
                                                      THESE TERMS OF SERVICE,
                                                      THEN YOU ARE EXPRESSLY
                                                      PROHIBITED FROM USING THE
                                                      SITE AND YOU MUST
                                                      DISCONTINUE USE
                                                      IMMEDIATELY.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      Supplemental terms and
                                                      conditions or documents
                                                      that may be posted on the
                                                      Site from time to time are
                                                      hereby expressly
                                                      incorporated herein by
                                                      reference. We reserve the
                                                      right, in our sole
                                                      discretion, to make
                                                      changes or modifications
                                                      to these Terms of Service
                                                      from time to time. We will
                                                      alert you about any
                                                      changes by updating the
                                                      &ldquo;Last updated&rdquo;
                                                      date of these Terms of
                                                      Service, and you waive any
                                                      right to receive specific
                                                      notice of each such
                                                      change. Please ensure that
                                                      you check the applicable
                                                      Terms every time you use
                                                      our Site so that you
                                                      understand which Terms
                                                      apply. You will be subject
                                                      to, and will be deemed to
                                                      have been made aware of
                                                      and to have accepted, the
                                                      changes in any revised
                                                      Terms of Service by your
                                                      continued use of the Site
                                                      after the date such
                                                      revised Terms of Service
                                                      are posted.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      The information provided
                                                      on the Site is not
                                                      intended for distribution
                                                      to or use by any person or
                                                      entity in any jurisdiction
                                                      or country where such
                                                      distribution or use would
                                                      be contrary to law or
                                                      regulation or which would
                                                      subject us to any
                                                      registration requirement
                                                      within such jurisdiction
                                                      or country. Accordingly,
                                                      those persons who choose
                                                      to access the Site from
                                                      other locations do so on
                                                      their own initiative and
                                                      are solely responsible for
                                                      compliance with local
                                                      laws, if and to the extent
                                                      local laws are applicable.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      The Site is not tailored
                                                      to comply with
                                                      industry-specific
                                                      regulations (Health
                                                      Insurance Portability and
                                                      Accountability Act
                                                      (HIPAA), Federal
                                                      Information Security
                                                      Management Act (FISMA),
                                                      etc.), so if your
                                                      interactions would be
                                                      subjected to such laws,
                                                      you may not use this Site.
                                                      You may not use the Site
                                                      in a way that would
                                                      violate the
                                                      Gramm-Leach-Bliley Act
                                                      (GLBA).
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      The Site is intended for
                                                      users who are at least 13
                                                      years of age. All users
                                                      who are minors in the
                                                      jurisdiction in which they
                                                      reside (generally under
                                                      the age of 18) must have
                                                      the permission of, and be
                                                      directly supervised by,
                                                      their parent or guardian
                                                      to use the Site. If you
                                                      are a minor, you must have
                                                      your parent or guardian
                                                      read and agree to these
                                                      Terms of
                                                      Service&nbsp;prior to you
                                                      using the Site.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_b6y29mp52qvx"></a
                                                      ><strong
                                                        >2. INTELLECTUAL
                                                        PROPERTY RIGHTS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      Unless otherwise
                                                      indicated, the Site is our
                                                      proprietary property and
                                                      all source code,
                                                      databases, functionality,
                                                      software, website designs,
                                                      audio, video, text,
                                                      photographs, and graphics
                                                      on the Site (collectively,
                                                      the &ldquo;Content&rdquo;)
                                                      and the trademarks,
                                                      service marks, and logos
                                                      contained therein (the
                                                      &ldquo;Marks&rdquo;) are
                                                      owned or controlled by us
                                                      or licensed to us, and are
                                                      protected by copyright and
                                                      trademark laws and various
                                                      other intellectual
                                                      property rights and unfair
                                                      competition laws of the
                                                      United States,
                                                      international copyright
                                                      laws, and international
                                                      conventions. The Content
                                                      and the Marks are provided
                                                      on the Site &ldquo;AS
                                                      IS&rdquo; for your
                                                      information and personal
                                                      use only. Except as
                                                      expressly provided in
                                                      these Terms of Service, no
                                                      part of the Site and no
                                                      Content or Marks may be
                                                      copied, reproduced,
                                                      aggregated, republished,
                                                      uploaded, posted, publicly
                                                      displayed, encoded,
                                                      translated, transmitted,
                                                      distributed, sold,
                                                      licensed, or otherwise
                                                      exploited for any
                                                      commercial purpose
                                                      whatsoever, without our
                                                      express prior written
                                                      permission.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      Provided that you are
                                                      eligible to use the Site,
                                                      you are granted a limited
                                                      license to access and use
                                                      the Site and to download
                                                      or print a copy of any
                                                      portion of the Content to
                                                      which you have properly
                                                      gained access solely for
                                                      your personal,
                                                      non-commercial use. We
                                                      reserve all rights not
                                                      expressly granted to you
                                                      in and to the Site, the
                                                      Content and the Marks.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_5hg7kgyv9l8z"></a
                                                      ><strong
                                                        >3. USER
                                                        REPRESENTATIONS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      By using the Site, you
                                                      represent and warrant
                                                      that:&nbsp;(1)&nbsp;all
                                                      registration information
                                                      you submit will be true,
                                                      accurate, current, and
                                                      complete; (2) you will
                                                      maintain the accuracy of
                                                      such information and
                                                      promptly update such
                                                      registration
                                                      information&nbsp;as
                                                      necessary;&nbsp;(3) you
                                                      have the legal capacity
                                                      and you agree to comply
                                                      with these Terms of
                                                      Service; (4)&nbsp;you are
                                                      not under the age of
                                                      13;&nbsp;(5) you are not a
                                                      minor in the jurisdiction
                                                      in which you
                                                      reside,&nbsp;or if a
                                                      minor, you have received
                                                      parental permission to use
                                                      the Site;&nbsp;(6) you
                                                      will not access the Site
                                                      through automated or
                                                      non-human means, whether
                                                      through a bot, script or
                                                      otherwise;&nbsp;(7) you
                                                      will not use the Site for
                                                      any illegal or
                                                      unauthorized purpose; and
                                                      (8) your use of the Site
                                                      will not violate any
                                                      applicable law or
                                                      regulation.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      If you provide any
                                                      information that is
                                                      untrue, inaccurate, not
                                                      current, or incomplete, we
                                                      have the right to suspend
                                                      or terminate your account
                                                      and refuse any and all
                                                      current or future use of
                                                      the Site (or any portion
                                                      thereof).
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="heading_1">
                                                        <strong
                                                          >4. USER
                                                          REGISTRATION</strong
                                                        >
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        You may be required to
                                                        register with the Site.
                                                        You agree to keep your
                                                        password confidential
                                                        and will be responsible
                                                        for all use of your
                                                        account and password. We
                                                        reserve the right to
                                                        remove, reclaim, or
                                                        change a username you
                                                        select if we determine,
                                                        in our sole discretion,
                                                        that such username is
                                                        inappropriate, obscene,
                                                        or otherwise
                                                        objectionable.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        &nbsp;
                                                      </div>
                                                    </div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_ynub0jdx8pob"></a
                                                      ><strong
                                                        >5. FEES AND
                                                        PAYMENT</strong
                                                      >
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We accept the following
                                                      forms of payment:
                                                    </div>
                                                    <div>
                                                      <div>
                                                        <div
                                                          data-custom-class="body_text">
                                                          - Visa
                                                        </div>
                                                        <div
                                                          data-custom-class="body_text">
                                                          - Mastercard
                                                        </div>
                                                        <div
                                                          data-custom-class="body_text">
                                                          - American Express
                                                        </div>
                                                        <div
                                                          data-custom-class="body_text">
                                                          - Discover
                                                        </div>
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        You may be required to
                                                        purchase or pay a fee to
                                                        access some of our
                                                        services. You agree to
                                                        provide current,
                                                        complete, and accurate
                                                        purchase and account
                                                        information for all
                                                        purchases made via the
                                                        Site. You further agree
                                                        to promptly update
                                                        account and payment
                                                        information, including
                                                        email address, payment
                                                        method, and payment card
                                                        expiration date, so that
                                                        we can complete your
                                                        transactions and contact
                                                        you as needed. We bill
                                                        you through an online
                                                        billing account for
                                                        purchases made via the
                                                        Site. Sales tax will be
                                                        added to the price of
                                                        purchases as deemed
                                                        required by us. We may
                                                        change prices at any
                                                        time. All payments shall
                                                        be in U.S. dollars.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        You agree to pay all
                                                        charges or fees at the
                                                        prices then in effect
                                                        for your purchases, and
                                                        you authorize us to
                                                        charge your chosen
                                                        payment provider for any
                                                        such amounts upon making
                                                        your purchase.
                                                        If&nbsp;your purchase is
                                                        subject to recurring
                                                        charges, then you
                                                        consent to our charging
                                                        your payment method on a
                                                        recurring basis without
                                                        requiring your prior
                                                        approval for each
                                                        recurring charge, until
                                                        you notify us of your
                                                        cancellation.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        We reserve the right to
                                                        correct any errors or
                                                        mistakes in pricing,
                                                        even if we have already
                                                        requested or received
                                                        payment. We also reserve
                                                        the right to refuse any
                                                        order placed through the
                                                        Site.
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div>
                                                        <a
                                                          name="_drzjqilz2ujm"></a>
                                                      </div>
                                                      <div>&nbsp;</div>
                                                      <div
                                                        data-custom-class="heading_1">
                                                        <a
                                                          name="_e993diqrk0qx"></a
                                                        ><strong
                                                          >6.
                                                          CANCELLATION</strong
                                                        >
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        All purchases are
                                                        non-refundable.&nbsp;You
                                                        can cancel your
                                                        subscription at any
                                                        time&nbsp;by logging
                                                        into your account or
                                                        contacting us using the
                                                        contact&nbsp;information
                                                        provided below. Your
                                                        cancellation will take
                                                        effect at the end of the
                                                        current paid term.
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        If you are unsatisfied
                                                        with our services,
                                                        please email us at
                                                        <a
                                                          href="mailto:support@jov.ie"
                                                          >support@jov.ie</a
                                                        >.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        &nbsp;
                                                      </div>
                                                      <div>
                                                        <div
                                                          data-custom-class="heading_1">
                                                          <strong
                                                            >7. SOFTWARE</strong
                                                          >
                                                        </div>
                                                      </div>
                                                      <div>
                                                        <div
                                                          data-custom-class="body_text">
                                                          We may include
                                                          software for use in
                                                          connection with our
                                                          services. If such
                                                          software is
                                                          accompanied by an end
                                                          user license agreement
                                                          (&ldquo;EULA&rdquo;),
                                                          the terms of the EULA
                                                          will govern your use
                                                          of the software. If
                                                          such software is not
                                                          accompanied by a EULA,
                                                          then we grant to you a
                                                          non-exclusive,
                                                          revocable, personal,
                                                          and non-transferable
                                                          license to use such
                                                          software solely in
                                                          connection with our
                                                          services and in
                                                          accordance with these
                                                          Terms of Service. Any
                                                          Software and any
                                                          related documentation
                                                          is provided &ldquo;as
                                                          is&rdquo; without
                                                          warranty of any kind,
                                                          either express or
                                                          implied, including,
                                                          without limitation,
                                                          the implied warranties
                                                          of merchantability,
                                                          fitness for a
                                                          particular purpose, or
                                                          non-infringement. You
                                                          accept any and all
                                                          risk arising out of
                                                          use or performance of
                                                          any Software. You may
                                                          not reproduce or
                                                          redistribute any
                                                          software except in
                                                          accordance with the
                                                          EULA or these Terms of
                                                          Service.
                                                        </div>
                                                        <div
                                                          data-custom-class="body_text">
                                                          &nbsp;
                                                        </div>
                                                      </div>
                                                      <div
                                                        data-custom-class="heading_1">
                                                        <a
                                                          name="_h284p8mrs3r7"></a
                                                        ><strong
                                                          >8. PROHIBITED
                                                          ACTIVITIES</strong
                                                        >
                                                      </div>
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      You may not access or use
                                                      the Site for any purpose
                                                      other than that for which
                                                      we make the Site
                                                      available. The Site may
                                                      not be used in connection
                                                      with any commercial
                                                      endeavors except those
                                                      that are specifically
                                                      endorsed or approved by
                                                      us.
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        As a user of the Site,
                                                        you agree not to:
                                                      </div>
                                                      <ul>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Systematically
                                                          retrieve data or other
                                                          content from the Site
                                                          to create or compile,
                                                          directly or
                                                          indirectly, a
                                                          collection,
                                                          compilation, database,
                                                          or directory without
                                                          written permission
                                                          from us.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Trick, defraud, or
                                                          mislead us and other
                                                          users, especially in
                                                          any attempt to learn
                                                          sensitive account
                                                          information such as
                                                          user passwords.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Circumvent, disable,
                                                          or otherwise interfere
                                                          with security-related
                                                          features of the Site,
                                                          including features
                                                          that prevent or
                                                          restrict the use or
                                                          copying of any Content
                                                          or enforce limitations
                                                          on the use of the Site
                                                          and/or the Content
                                                          contained therein.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Disparage, tarnish, or
                                                          otherwise harm, in our
                                                          opinion, us and/or the
                                                          Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Use any information
                                                          obtained from the Site
                                                          in order to harass,
                                                          abuse, or harm another
                                                          person.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Make improper use of
                                                          our support services
                                                          or submit false
                                                          reports of abuse or
                                                          misconduct.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Use the Site in a
                                                          manner inconsistent
                                                          with any applicable
                                                          laws or regulations.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Engage in unauthorized
                                                          framing of or linking
                                                          to the Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Upload or transmit (or
                                                          attempt to upload or
                                                          to transmit) viruses,
                                                          Trojan horses, or
                                                          other material,
                                                          including excessive
                                                          use of capital letters
                                                          and spamming
                                                          (continuous posting of
                                                          repetitive text), that
                                                          interferes with any
                                                          party&rsquo;s
                                                          uninterrupted use and
                                                          enjoyment of the Site
                                                          or modifies, impairs,
                                                          disrupts, alters, or
                                                          interferes with the
                                                          use, features,
                                                          functions, operation,
                                                          or maintenance of the
                                                          Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Engage in any
                                                          automated use of the
                                                          system, such as using
                                                          scripts to send
                                                          comments or messages,
                                                          or using any data
                                                          mining, robots, or
                                                          similar data gathering
                                                          and extraction tools.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Delete the copyright
                                                          or other proprietary
                                                          rights notice from any
                                                          Content.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Attempt to impersonate
                                                          another user or person
                                                          or use the username of
                                                          another user.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Upload or transmit (or
                                                          attempt to upload or
                                                          to transmit) any
                                                          material that acts as
                                                          a passive or active
                                                          information collection
                                                          or transmission
                                                          mechanism, including
                                                          without limitation,
                                                          clear graphics
                                                          interchange formats
                                                          (&ldquo;gifs&rdquo;),
                                                          1&times;1 pixels, web
                                                          bugs, cookies, or
                                                          other similar devices
                                                          (sometimes referred to
                                                          as
                                                          &ldquo;spyware&rdquo;
                                                          or &ldquo;passive
                                                          collection
                                                          mechanisms&rdquo; or
                                                          &ldquo;pcms&rdquo;).
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Interfere with,
                                                          disrupt, or create an
                                                          undue burden on the
                                                          Site or the networks
                                                          or services connected
                                                          to the Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Harass, annoy,
                                                          intimidate, or
                                                          threaten any of our
                                                          employees or agents
                                                          engaged in providing
                                                          any portion of the
                                                          Site to you.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Attempt to bypass any
                                                          measures of the Site
                                                          designed to prevent or
                                                          restrict access to the
                                                          Site, or any portion
                                                          of the Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Copy or adapt the
                                                          Site&rsquo;s software,
                                                          including but not
                                                          limited to Flash, PHP,
                                                          HTML, JavaScript, or
                                                          other code.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Except as permitted by
                                                          applicable law,
                                                          decipher, decompile,
                                                          disassemble, or
                                                          reverse engineer any
                                                          of the software
                                                          comprising or in any
                                                          way making up a part
                                                          of the Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Except as may be the
                                                          result of standard
                                                          search engine or
                                                          Internet browser
                                                          usage, use, launch,
                                                          develop, or distribute
                                                          any automated system,
                                                          including without
                                                          limitation, any
                                                          spider, robot, cheat
                                                          utility, scraper, or
                                                          offline reader that
                                                          accesses the Site, or
                                                          using or launching any
                                                          unauthorized script or
                                                          other software.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Use a buying agent or
                                                          purchasing agent to
                                                          make purchases on the
                                                          Site.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Make any unauthorized
                                                          use of the Site,
                                                          including collecting
                                                          usernames and/or email
                                                          addresses of users by
                                                          electronic or other
                                                          means for the purpose
                                                          of sending unsolicited
                                                          email, or creating
                                                          user accounts by
                                                          automated means or
                                                          under false pretenses.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Use the Site as part
                                                          of any effort to
                                                          compete with us or
                                                          otherwise use the Site
                                                          and/or the Content for
                                                          any revenue-generating
                                                          endeavor or commercial
                                                          enterprise.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Use the Site to
                                                          advertise or offer to
                                                          sell goods and
                                                          services.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Sell or otherwise
                                                          transfer your profile.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Sell data to other
                                                          parties.
                                                        </li>
                                                      </ul>
                                                    </div>
                                                    <div>
                                                      <a
                                                        name="_zbbv9tgty199"></a>
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <strong
                                                        >9. USER GENERATED
                                                        CONTRIBUTIONS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        The Site may invite you
                                                        to chat, contribute to,
                                                        or participate in blogs,
                                                        message boards, online
                                                        forums, and other
                                                        functionality, and may
                                                        provide you with the
                                                        opportunity to create,
                                                        submit, post, display,
                                                        transmit, perform,
                                                        publish, distribute, or
                                                        broadcast content and
                                                        materials to us or on
                                                        the Site, including but
                                                        not limited to text,
                                                        writings, video, audio,
                                                        photographs, graphics,
                                                        comments, suggestions,
                                                        or personal information
                                                        or other material
                                                        (collectively,
                                                        "Contributions").
                                                        Contributions may be
                                                        viewable by other users
                                                        of the Site and through
                                                        third-party websites. As
                                                        such, any Contributions
                                                        you transmit may be
                                                        treated as
                                                        non-confidential and
                                                        non-proprietary. When
                                                        you create or make
                                                        available any
                                                        Contributions, you
                                                        thereby represent and
                                                        warrant that:
                                                      </div>
                                                      <ul>
                                                        <li
                                                          data-custom-class="body_text">
                                                          The creation,
                                                          distribution,
                                                          transmission, public
                                                          display, or
                                                          performance, and the
                                                          accessing,
                                                          downloading, or
                                                          copying of your
                                                          Contributions do not
                                                          and will not infringe
                                                          the proprietary
                                                          rights, including but
                                                          not limited to the
                                                          copyright, patent,
                                                          trademark, trade
                                                          secret, or moral
                                                          rights of any third
                                                          party.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          You are the creator
                                                          and owner of or have
                                                          the necessary
                                                          licenses, rights,
                                                          consents, releases,
                                                          and permissions to use
                                                          and to authorize us,
                                                          the Site, and other
                                                          users of the Site to
                                                          use your Contributions
                                                          in any manner
                                                          contemplated by the
                                                          Site and these Terms
                                                          of Service.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          You have the written
                                                          consent, release,
                                                          and/or permission of
                                                          each and every
                                                          identifiable
                                                          individual person in
                                                          your Contributions to
                                                          use the name or
                                                          likeness of each and
                                                          every such
                                                          identifiable
                                                          individual person to
                                                          enable inclusion and
                                                          use of your
                                                          Contributions in any
                                                          manner contemplated by
                                                          the Site and these
                                                          Terms of Service.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions are
                                                          not false, inaccurate,
                                                          or misleading.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions are
                                                          not unsolicited or
                                                          unauthorized
                                                          advertising,
                                                          promotional materials,
                                                          pyramid schemes, chain
                                                          letters, spam, mass
                                                          mailings, or other
                                                          forms of solicitation.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions are
                                                          not obscene, lewd,
                                                          lascivious, filthy,
                                                          violent, harassing,
                                                          libelous, slanderous,
                                                          or otherwise
                                                          objectionable (as
                                                          determined by us).
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions do
                                                          not ridicule, mock,
                                                          disparage, intimidate,
                                                          or abuse anyone.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions are
                                                          not used to harass or
                                                          threaten (in the legal
                                                          sense of those terms)
                                                          any other person and
                                                          to promote violence
                                                          against a specific
                                                          person or class of
                                                          people.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions do
                                                          not violate any
                                                          applicable law,
                                                          regulation, or rule.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions do
                                                          not violate the
                                                          privacy or publicity
                                                          rights of any third
                                                          party.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions do
                                                          not violate any
                                                          applicable law
                                                          concerning child
                                                          pornography, or
                                                          otherwise intended to
                                                          protect the health or
                                                          well-being of minors.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions do
                                                          not include any
                                                          offensive comments
                                                          that are connected to
                                                          race, national origin,
                                                          gender, sexual
                                                          preference, or
                                                          physical handicap.
                                                        </li>
                                                        <li
                                                          data-custom-class="body_text">
                                                          Your Contributions do
                                                          not otherwise violate,
                                                          or link to material
                                                          that violates, any
                                                          provision of these
                                                          Terms of Service, or
                                                          any applicable law or
                                                          regulation.
                                                        </li>
                                                      </ul>
                                                      <div
                                                        data-custom-class="body_text">
                                                        Any use of the Site in
                                                        violation of the
                                                        foregoing violates these
                                                        Terms of Service and may
                                                        result in, among other
                                                        things, termination or
                                                        suspension of your
                                                        rights to use the Site.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        &nbsp;
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <strong
                                                        >10. CONTRIBUTION
                                                        LICENSE</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      By posting your
                                                      Contributions to any part
                                                      of the Site&nbsp;or making
                                                      Contributions accessible
                                                      to the Site by linking
                                                      your account from the Site
                                                      to any of your social
                                                      networking accounts, you
                                                      automatically grant, and
                                                      you represent and warrant
                                                      that you have the right to
                                                      grant, to us an
                                                      unrestricted, unlimited,
                                                      irrevocable, perpetual,
                                                      non-exclusive,
                                                      transferable,
                                                      royalty-free, fully-paid,
                                                      worldwide right, and
                                                      license to host, use,
                                                      copy, reproduce, disclose,
                                                      sell, resell, publish,
                                                      broadcast, retitle,
                                                      archive, store, cache,
                                                      publicly perform, publicly
                                                      display, reformat,
                                                      translate, transmit,
                                                      excerpt (in whole or in
                                                      part), and distribute such
                                                      Contributions (including,
                                                      without limitation, your
                                                      image and voice) for any
                                                      purpose, commercial,
                                                      advertising, or otherwise,
                                                      and to prepare derivative
                                                      works of, or incorporate
                                                      into other works, such
                                                      Contributions, and grant
                                                      and authorize sublicenses
                                                      of the foregoing. The use
                                                      and distribution may occur
                                                      in any media formats and
                                                      through any media
                                                      channels.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      This license will apply to
                                                      any form, media, or
                                                      technology now known or
                                                      hereafter developed, and
                                                      includes our use of your
                                                      name, company name, and
                                                      franchise name, as
                                                      applicable, and any of the
                                                      trademarks, service marks,
                                                      trade names, logos, and
                                                      personal and commercial
                                                      images you provide. You
                                                      waive all moral rights in
                                                      your Contributions, and
                                                      you warrant that moral
                                                      rights have not otherwise
                                                      been asserted in your
                                                      Contributions.&nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We do not assert any
                                                      ownership over your
                                                      Contributions. You retain
                                                      full ownership of all of
                                                      your Contributions and any
                                                      intellectual property
                                                      rights or other
                                                      proprietary rights
                                                      associated with your
                                                      Contributions. We are not
                                                      liable for any statements
                                                      or representations in your
                                                      Contributions provided by
                                                      you in any area on the
                                                      Site. You are solely
                                                      responsible for your
                                                      Contributions to the Site
                                                      and you expressly agree to
                                                      exonerate us from any and
                                                      all responsibility and to
                                                      refrain from any legal
                                                      action against us
                                                      regarding your
                                                      Contributions.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We have the right, in our
                                                      sole and absolute
                                                      discretion, (1) to edit,
                                                      redact, or otherwise
                                                      change any Contributions;
                                                      (2) to re-categorize any
                                                      Contributions to place
                                                      them in more appropriate
                                                      locations on the Site; and
                                                      (3) to pre-screen or
                                                      delete any Contributions
                                                      at any time and for any
                                                      reason, without notice. We
                                                      have no obligation to
                                                      monitor your
                                                      Contributions.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <strong
                                                        >11. MOBILE APPLICATION
                                                        LICENSE</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_2">
                                                      <strong
                                                        >Use License</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      If you access the Site via
                                                      a mobile application, then
                                                      we grant you a revocable,
                                                      non-exclusive,
                                                      non-transferable, limited
                                                      right to install and use
                                                      the mobile application on
                                                      wireless electronic
                                                      devices owned or
                                                      controlled by you, and to
                                                      access and use the mobile
                                                      application on such
                                                      devices strictly in
                                                      accordance with the terms
                                                      and conditions of this
                                                      mobile application license
                                                      contained in these Terms
                                                      of Service. You shall not:
                                                      (1) except as permitted by
                                                      applicable law, decompile,
                                                      reverse engineer,
                                                      disassemble, attempt to
                                                      derive the source code of,
                                                      or decrypt the
                                                      application; (2) make any
                                                      modification, adaptation,
                                                      improvement, enhancement,
                                                      translation, or derivative
                                                      work from the application;
                                                      (3) violate any applicable
                                                      laws, rules, or
                                                      regulations in connection
                                                      with your access or use of
                                                      the application; (4)
                                                      remove, alter, or obscure
                                                      any proprietary notice
                                                      (including any notice of
                                                      copyright or trademark)
                                                      posted by us or the
                                                      licensors of the
                                                      application; (5) use the
                                                      application for any
                                                      revenue generating
                                                      endeavor, commercial
                                                      enterprise, or other
                                                      purpose for which it is
                                                      not designed or intended;
                                                      (6) make the application
                                                      available over a network
                                                      or other environment
                                                      permitting access or use
                                                      by multiple devices or
                                                      users at the same time;
                                                      (7) use the application
                                                      for creating a product,
                                                      service, or software that
                                                      is, directly or
                                                      indirectly, competitive
                                                      with or in any way a
                                                      substitute for the
                                                      application; (8) use the
                                                      application to send
                                                      automated queries to any
                                                      website or to send any
                                                      unsolicited commercial
                                                      e-mail; or (9) use any
                                                      proprietary information or
                                                      any of our interfaces or
                                                      our other intellectual
                                                      property in the design,
                                                      development, manufacture,
                                                      licensing, or distribution
                                                      of any applications,
                                                      accessories, or devices
                                                      for use with the
                                                      application.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_2">
                                                      <a name="_vzf0b5xscg"></a
                                                      ><strong
                                                        >Apple and Android
                                                        Devices</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      The following terms apply
                                                      when you use a mobile
                                                      application obtained from
                                                      either the Apple Store or
                                                      Google Play (each an
                                                      &ldquo;App
                                                      Distributor&rdquo;) to
                                                      access the Site: (1) the
                                                      license granted to you for
                                                      our mobile application is
                                                      limited to a
                                                      non-transferable license
                                                      to use the application on
                                                      a device that utilizes the
                                                      Apple iOS or Android
                                                      operating systems, as
                                                      applicable, and in
                                                      accordance with the usage
                                                      rules set forth in the
                                                      applicable App
                                                      Distributor&rsquo;s terms
                                                      of service; (2) we are
                                                      responsible for providing
                                                      any maintenance and
                                                      support services with
                                                      respect to the mobile
                                                      application as specified
                                                      in the terms and
                                                      conditions of this mobile
                                                      application license
                                                      contained in these Terms
                                                      of Service or as otherwise
                                                      required under applicable
                                                      law, and you acknowledge
                                                      that each App Distributor
                                                      has no obligation
                                                      whatsoever to furnish any
                                                      maintenance and support
                                                      services with respect to
                                                      the mobile application;
                                                      (3) in the event of any
                                                      failure of the mobile
                                                      application to conform to
                                                      any applicable warranty,
                                                      you may notify the
                                                      applicable App
                                                      Distributor, and the App
                                                      Distributor, in accordance
                                                      with its terms and
                                                      policies, may refund the
                                                      purchase price, if any,
                                                      paid for the mobile
                                                      application, and to the
                                                      maximum extent permitted
                                                      by applicable law, the App
                                                      Distributor will have no
                                                      other warranty obligation
                                                      whatsoever with respect to
                                                      the mobile application;
                                                      (4) you represent and
                                                      warrant that (i) you are
                                                      not located in a country
                                                      that is subject to a U.S.
                                                      government embargo, or
                                                      that has been designated
                                                      by the U.S. government as
                                                      a &ldquo;terrorist
                                                      supporting&rdquo; country
                                                      and (ii) you are not
                                                      listed on any U.S.
                                                      government list of
                                                      prohibited or restricted
                                                      parties; (5) you must
                                                      comply with applicable
                                                      third-party terms of
                                                      agreement when using the
                                                      mobile application, e.g.,
                                                      if you have a VoIP
                                                      application, then you must
                                                      not be in violation of
                                                      their wireless data
                                                      service agreement when
                                                      using the mobile
                                                      application; and (6) you
                                                      acknowledge and agree that
                                                      the App Distributors are
                                                      third-party beneficiaries
                                                      of the terms and
                                                      conditions in this mobile
                                                      application license
                                                      contained in these Terms
                                                      of Service, and that each
                                                      App Distributor will have
                                                      the right (and will be
                                                      deemed to have accepted
                                                      the right) to enforce the
                                                      terms and conditions in
                                                      this mobile application
                                                      license contained in these
                                                      Terms of Service against
                                                      you as a third-party
                                                      beneficiary thereof.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <strong
                                                        >12. SOCIAL
                                                        MEDIA</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      As part of the
                                                      functionality of the Site,
                                                      you may link your account
                                                      with online accounts you
                                                      have with third-party
                                                      service providers (each
                                                      such account, a
                                                      &ldquo;Third-Party
                                                      Account&rdquo;) by either:
                                                      (1) providing your
                                                      Third-Party Account login
                                                      information through the
                                                      Site; or (2) allowing us
                                                      to access your Third-Party
                                                      Account, as is permitted
                                                      under the applicable terms
                                                      and conditions that govern
                                                      your use of each
                                                      Third-Party Account. You
                                                      represent and warrant that
                                                      you are entitled to
                                                      disclose your Third-Party
                                                      Account login information
                                                      to us and/or grant us
                                                      access to your Third-Party
                                                      Account, without breach by
                                                      you of any of the terms
                                                      and conditions that govern
                                                      your use of the applicable
                                                      Third-Party Account, and
                                                      without obligating us to
                                                      pay any fees or making us
                                                      subject to any usage
                                                      limitations imposed by the
                                                      third-party service
                                                      provider of the
                                                      Third-Party Account. By
                                                      granting us access to any
                                                      Third-Party Accounts, you
                                                      understand that (1) we may
                                                      access, make available,
                                                      and store (if applicable)
                                                      any content that you have
                                                      provided to and stored in
                                                      your Third-Party Account
                                                      (the &ldquo;Social Network
                                                      Content&rdquo;) so that it
                                                      is available on and
                                                      through the Site via your
                                                      account, including without
                                                      limitation any friend
                                                      lists and (2) we may
                                                      submit to and receive from
                                                      your Third-Party Account
                                                      additional information to
                                                      the extent you are
                                                      notified when you link
                                                      your account with the
                                                      Third-Party Account.
                                                      Depending on the
                                                      Third-Party Accounts you
                                                      choose and subject to the
                                                      privacy settings that you
                                                      have set in such
                                                      Third-Party Accounts,
                                                      personally identifiable
                                                      information that you post
                                                      to your Third-Party
                                                      Accounts may be available
                                                      on and through your
                                                      account on the Site.
                                                      Please note that if a
                                                      Third-Party Account or
                                                      associated service becomes
                                                      unavailable or our access
                                                      to such Third-Party
                                                      Account is terminated by
                                                      the third-party service
                                                      provider, then Social
                                                      Network Content may no
                                                      longer be available on and
                                                      through the Site. You will
                                                      have the ability to
                                                      disable the connection
                                                      between your account on
                                                      the Site and your
                                                      Third-Party Accounts at
                                                      any time. PLEASE NOTE THAT
                                                      YOUR RELATIONSHIP WITH THE
                                                      THIRD-PARTY SERVICE
                                                      PROVIDERS ASSOCIATED WITH
                                                      YOUR THIRD-PARTY ACCOUNTS
                                                      IS GOVERNED SOLELY BY YOUR
                                                      AGREEMENT(S) WITH SUCH
                                                      THIRD-PARTY SERVICE
                                                      PROVIDERS. We make no
                                                      effort to review any
                                                      Social Network Content for
                                                      any purpose, including but
                                                      not limited to, for
                                                      accuracy, legality, or
                                                      non-infringement, and we
                                                      are not responsible for
                                                      any Social Network
                                                      Content. You acknowledge
                                                      and agree that we may
                                                      access your email address
                                                      book associated with a
                                                      Third-Party Account and
                                                      your contacts list stored
                                                      on your mobile device or
                                                      tablet computer solely for
                                                      purposes of identifying
                                                      and informing you of those
                                                      contacts who have also
                                                      registered to use the
                                                      Site. You can deactivate
                                                      the connection between the
                                                      Site and your Third-Party
                                                      Account by contacting us
                                                      using the contact
                                                      information below or
                                                      through your account
                                                      settings (if applicable).
                                                      We will attempt to delete
                                                      any information stored on
                                                      our servers that was
                                                      obtained through such
                                                      Third-Party Account,
                                                      except the username and
                                                      profile picture that
                                                      become associated with
                                                      your account.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_wfq2hvrw11j4"></a
                                                      ><strong
                                                        >13. SUBMISSIONS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      You acknowledge and agree
                                                      that any questions,
                                                      comments, suggestions,
                                                      ideas, feedback, or other
                                                      information regarding the
                                                      Site ("Submissions")
                                                      provided by you to us are
                                                      non-confidential and shall
                                                      become our sole property.
                                                      We shall own exclusive
                                                      rights, including all
                                                      intellectual property
                                                      rights, and shall be
                                                      entitled to the
                                                      unrestricted use and
                                                      dissemination of these
                                                      Submissions for any lawful
                                                      purpose, commercial or
                                                      otherwise, without
                                                      acknowledgment or
                                                      compensation to you. You
                                                      hereby waive all moral
                                                      rights to any such
                                                      Submissions, and you
                                                      hereby warrant that any
                                                      such Submissions are
                                                      original with you or that
                                                      you have the right to
                                                      submit such Submissions.
                                                      You agree there shall be
                                                      no recourse against us for
                                                      any alleged or actual
                                                      infringement or
                                                      misappropriation of any
                                                      proprietary right in your
                                                      Submissions.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="heading_1">
                                                        <strong
                                                          >14. THIRD-PARTY
                                                          WEBSITES AND
                                                          CONTENT</strong
                                                        >
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        The Site may contain (or
                                                        you may be sent via the
                                                        Site) links to other
                                                        websites ("Third-Party
                                                        Websites") as well as
                                                        articles, photographs,
                                                        text, graphics,
                                                        pictures, designs,
                                                        music, sound, video,
                                                        information,
                                                        applications, software,
                                                        and other content or
                                                        items belonging to or
                                                        originating from third
                                                        parties ("Third-Party
                                                        Content"). Such
                                                        Third-Party Websites and
                                                        Third-Party Content are
                                                        not investigated,
                                                        monitored, or checked
                                                        for accuracy,
                                                        appropriateness, or
                                                        completeness by us, and
                                                        we are not responsible
                                                        for any Third-Party
                                                        Websites accessed
                                                        through the Site or any
                                                        Third-Party Content
                                                        posted on, available
                                                        through, or installed
                                                        from the Site, including
                                                        the content, accuracy,
                                                        offensiveness, opinions,
                                                        reliability, privacy
                                                        practices, or other
                                                        policies of or contained
                                                        in the Third-Party
                                                        Websites or the
                                                        Third-Party Content.
                                                        Inclusion of, linking
                                                        to, or permitting the
                                                        use or installation of
                                                        any Third-Party Websites
                                                        or any Third-Party
                                                        Content does not imply
                                                        approval or endorsement
                                                        thereof by us. If you
                                                        decide to leave the Site
                                                        and access the
                                                        Third-Party Websites or
                                                        to use or install any
                                                        Third-Party Content, you
                                                        do so at your own risk,
                                                        and you should be aware
                                                        these Terms of Service
                                                        no longer govern. You
                                                        should review the
                                                        applicable terms and
                                                        policies, including
                                                        privacy and data
                                                        gathering practices, of
                                                        any website to which you
                                                        navigate from the Site
                                                        or relating to any
                                                        applications you use or
                                                        install from the Site.
                                                        Any purchases you make
                                                        through Third-Party
                                                        Websites will be through
                                                        other websites and from
                                                        other companies, and we
                                                        take no responsibility
                                                        whatsoever in relation
                                                        to such purchases which
                                                        are exclusively between
                                                        you and the applicable
                                                        third party. You agree
                                                        and acknowledge that we
                                                        do not endorse the
                                                        products or services
                                                        offered on Third-Party
                                                        Websites and you shall
                                                        hold us harmless from
                                                        any harm caused by your
                                                        purchase of such
                                                        products or services.
                                                        Additionally, you shall
                                                        hold us harmless from
                                                        any losses sustained by
                                                        you or harm caused to
                                                        you relating to or
                                                        resulting in any way
                                                        from any Third-Party
                                                        Content or any contact
                                                        with Third-Party
                                                        Websites.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        &nbsp;
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="heading_1">
                                                        <strong
                                                          >15. U.S. GOVERNMENT
                                                          RIGHTS</strong
                                                        >
                                                      </div>
                                                    </div>
                                                    <div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        Our services are
                                                        &ldquo;commercial
                                                        items&rdquo; as defined
                                                        in Federal Acquisition
                                                        Regulation
                                                        (&ldquo;FAR&rdquo;)
                                                        2.101. If our services
                                                        are acquired by or on
                                                        behalf of any agency not
                                                        within the Department of
                                                        Defense
                                                        (&ldquo;DOD&rdquo;), our
                                                        services are subject to
                                                        the terms of these Terms
                                                        of Service in accordance
                                                        with FAR 12.212 (for
                                                        computer software) and
                                                        FAR 12.211 (for
                                                        technical data). If our
                                                        services are acquired by
                                                        or on behalf of any
                                                        agency within the
                                                        Department of Defense,
                                                        our services are subject
                                                        to the terms of these
                                                        Terms of Service in
                                                        accordance with Defense
                                                        Federal Acquisition
                                                        Regulation
                                                        (&ldquo;DFARS&rdquo;)
                                                        227.7202-3. In addition,
                                                        DFARS 252.227-7015
                                                        applies to technical
                                                        data acquired by the
                                                        DOD. This U.S.
                                                        Government Rights clause
                                                        is in lieu of, and
                                                        supersedes, any other
                                                        FAR, DFARS, or other
                                                        clause or provision that
                                                        addresses government
                                                        rights in computer
                                                        software or technical
                                                        data under these Terms
                                                        of Service.
                                                      </div>
                                                      <div
                                                        data-custom-class="body_text">
                                                        &nbsp;
                                                      </div>
                                                    </div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_wj13r09u8u3u"></a
                                                      ><strong
                                                        >16. SITE
                                                        MANAGEMENT</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We reserve the right, but
                                                      not the obligation, to:
                                                      (1) monitor the Site for
                                                      violations of these Terms
                                                      of Service; (2) take
                                                      appropriate legal action
                                                      against anyone who, in our
                                                      sole discretion, violates
                                                      the law or these Terms of
                                                      Service, including without
                                                      limitation, reporting such
                                                      user to law enforcement
                                                      authorities; (3) in our
                                                      sole discretion and
                                                      without limitation,
                                                      refuse, restrict access
                                                      to, limit the availability
                                                      of, or disable (to the
                                                      extent technologically
                                                      feasible) any of your
                                                      Contributions or any
                                                      portion thereof; (4) in
                                                      our sole discretion and
                                                      without limitation,
                                                      notice, or liability, to
                                                      remove from the Site or
                                                      otherwise disable all
                                                      files and content that are
                                                      excessive in size or are
                                                      in any way burdensome to
                                                      our systems; and (5)
                                                      otherwise manage the Site
                                                      in a manner designed to
                                                      protect our rights and
                                                      property and to facilitate
                                                      the proper functioning of
                                                      the Site.
                                                    </div>
                                                    <div>
                                                      <a
                                                        name="_jugvcvcw0oj9"></a>
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <strong
                                                        >17. PRIVACY
                                                        POLICY</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We care about data privacy
                                                      and security. Please
                                                      review our Privacy Policy:
                                                      <strong
                                                        ><a
                                                          href="https://jov.ie/privacy"
                                                          target="_blank"
                                                          data-custom-class="link"
                                                          >https://jov.ie/privacy</a
                                                        ></strong
                                                      >. By using the Site, you
                                                      agree to be bound by our
                                                      Privacy Policy, which is
                                                      incorporated into these
                                                      Terms of Service. Please
                                                      be advised the Site is
                                                      hosted in the United
                                                      States. If you access the
                                                      Site from any other region
                                                      of the world with laws or
                                                      other requirements
                                                      governing personal data
                                                      collection, use, or
                                                      disclosure that differ
                                                      from applicable laws in
                                                      the United States, then
                                                      through your continued use
                                                      of the Site,&nbsp;you are
                                                      transferring your data to
                                                      the United States, and you
                                                      agree to have your data
                                                      transferred to and
                                                      processed in the United
                                                      States. Further, we do not
                                                      knowingly accept, request,
                                                      or solicit information
                                                      from children or knowingly
                                                      market to children.
                                                      Therefore, in accordance
                                                      with the U.S.
                                                      Children&rsquo;s Online
                                                      Privacy Protection Act, if
                                                      we receive actual
                                                      knowledge that anyone
                                                      under the age of 13 has
                                                      provided personal
                                                      information to us without
                                                      the requisite and
                                                      verifiable parental
                                                      consent, we will delete
                                                      that information from the
                                                      Site&nbsp;as quickly as is
                                                      reasonably practical.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <strong
                                                        >18. COPYRIGHT
                                                        INFRINGEMENTS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We respect the
                                                      intellectual property
                                                      rights of others. If you
                                                      believe that any material
                                                      available on or through
                                                      the Site infringes upon
                                                      any copyright you own or
                                                      control, please
                                                      immediately notify us
                                                      using the contact
                                                      information provided below
                                                      (a
                                                      &ldquo;Notification&rdquo;).
                                                      A copy of your
                                                      Notification will be sent
                                                      to the person who posted
                                                      or stored the material
                                                      addressed in the
                                                      Notification. Please be
                                                      advised that pursuant to
                                                      applicable law you may be
                                                      held liable for damages if
                                                      you make material
                                                      misrepresentations in a
                                                      Notification. Thus, if you
                                                      are not sure that material
                                                      located on or linked to by
                                                      the Site infringes your
                                                      copyright, you should
                                                      consider first contacting
                                                      an attorney.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_k3mndam4w6w1"></a
                                                      ><strong
                                                        >19. TERM AND
                                                        TERMINATION</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      These Terms of Service
                                                      shall remain in full force
                                                      and effect while you use
                                                      the Site. WITHOUT LIMITING
                                                      ANY OTHER PROVISION OF
                                                      THESE TERMS OF SERVICE, WE
                                                      RESERVE THE RIGHT TO, IN
                                                      OUR SOLE DISCRETION AND
                                                      WITHOUT NOTICE OR
                                                      LIABILITY, DENY ACCESS TO
                                                      AND USE OF THE SITE
                                                      (INCLUDING BLOCKING
                                                      CERTAIN IP ADDRESSES), TO
                                                      ANY PERSON FOR ANY REASON
                                                      OR FOR NO REASON,
                                                      INCLUDING WITHOUT
                                                      LIMITATION FOR BREACH OF
                                                      ANY REPRESENTATION,
                                                      WARRANTY, OR COVENANT
                                                      CONTAINED IN THESE TERMS
                                                      OF SERVICE OR OF ANY
                                                      APPLICABLE LAW OR
                                                      REGULATION. WE MAY
                                                      TERMINATE YOUR USE OR
                                                      PARTICIPATION IN THE SITE
                                                      OR DELETE
                                                      YOUR&nbsp;ACCOUNT
                                                      AND&nbsp;ANY CONTENT OR
                                                      INFORMATION THAT YOU
                                                      POSTED AT ANY TIME,
                                                      WITHOUT WARNING, IN OUR
                                                      SOLE DISCRETION.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      If we terminate or suspend
                                                      your account for any
                                                      reason, you are prohibited
                                                      from registering and
                                                      creating a new account
                                                      under your name, a fake or
                                                      borrowed name, or the name
                                                      of any third party, even
                                                      if you may be acting on
                                                      behalf of the third party.
                                                      In addition to terminating
                                                      or suspending your
                                                      account, we reserve the
                                                      right to take appropriate
                                                      legal action, including
                                                      without limitation
                                                      pursuing civil, criminal,
                                                      and injunctive redress.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_e2dep1hfgltt"></a
                                                      ><strong
                                                        >20. MODIFICATIONS AND
                                                        INTERRUPTIONS</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We reserve the right to
                                                      change, modify, or remove
                                                      the contents of the Site
                                                      at any time or for any
                                                      reason at our sole
                                                      discretion without notice.
                                                      However, we have no
                                                      obligation to update any
                                                      information on our Site.
                                                      We also reserve the right
                                                      to modify or discontinue
                                                      all or part of the Site
                                                      without notice at any
                                                      time. We will not be
                                                      liable to you or any third
                                                      party for any
                                                      modification, price
                                                      change, suspension, or
                                                      discontinuance of the
                                                      Site.
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      We cannot guarantee the
                                                      Site will be available at
                                                      all times. We may
                                                      experience hardware,
                                                      software, or other
                                                      problems or need to
                                                      perform maintenance
                                                      related to the Site,
                                                      resulting in
                                                      interruptions, delays, or
                                                      errors. We reserve the
                                                      right to change, revise,
                                                      update, suspend,
                                                      discontinue, or otherwise
                                                      modify the Site at any
                                                      time or for any reason
                                                      without notice to you. You
                                                      agree that we have no
                                                      liability whatsoever for
                                                      any loss, damage, or
                                                      inconvenience caused by
                                                      your inability to access
                                                      or use the Site during any
                                                      downtime or discontinuance
                                                      of the Site. Nothing in
                                                      these Terms of Service
                                                      will be construed to
                                                      obligate us to maintain
                                                      and support the Site or to
                                                      supply any corrections,
                                                      updates, or releases in
                                                      connection therewith.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_p6vbf8atcwhs"></a
                                                      ><strong
                                                        >21. GOVERNING
                                                        LAW</strong
                                                      >
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      These Terms of Service and
                                                      your use of the Site are
                                                      governed by and construed
                                                      in accordance with the
                                                      laws of the
                                                      State&nbsp;of&nbsp;California&nbsp;applicable
                                                      to agreements made and to
                                                      be entirely performed
                                                      within the State
                                                      of&nbsp;California,
                                                      without regard to its
                                                      conflict of law
                                                      principles.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_1">
                                                      <a
                                                        name="_v5i5tjw62cyw"></a
                                                      ><strong
                                                        >22. DISPUTE
                                                        RESOLUTION</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_2">
                                                      <strong
                                                        >Informal
                                                        Negotiations</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      To expedite resolution and
                                                      control the cost of any
                                                      dispute, controversy, or
                                                      claim related to these
                                                      Terms of Service (each
                                                      "Dispute" and
                                                      collectively, the
                                                      &ldquo;Disputes&rdquo;)
                                                      brought by either you or
                                                      us (individually, a
                                                      &ldquo;Party&rdquo; and
                                                      collectively, the
                                                      &ldquo;Parties&rdquo;),
                                                      the Parties agree to first
                                                      attempt to negotiate any
                                                      Dispute (except those
                                                      Disputes expressly
                                                      provided below) informally
                                                      for at least thirty (30)
                                                      days before initiating
                                                      arbitration. Such informal
                                                      negotiations commence upon
                                                      written notice from one
                                                      Party to the other Party.
                                                    </div>
                                                    <div
                                                      data-custom-class="body_text"
                                                      class="prose">
                                                      &nbsp;
                                                    </div>
                                                  </div>
                                                  <div>
                                                    <div
                                                      data-custom-class="heading_2">
                                                      <strong
                                                        >Binding
                                                        Arbitration</strong
                                                      >
                                                    </div>
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    If the Parties are unable to
                                                    resolve a Dispute through
                                                    informal negotiations, the
                                                    Dispute (except those
                                                    Disputes expressly excluded
                                                    below) will be finally and
                                                    exclusively resolved by
                                                    binding arbitration. YOU
                                                    UNDERSTAND THAT WITHOUT THIS
                                                    PROVISION, YOU WOULD HAVE
                                                    THE RIGHT TO SUE IN COURT
                                                    AND HAVE A JURY TRIAL. The
                                                    arbitration shall be
                                                    commenced and conducted
                                                    under the Commercial
                                                    Arbitration Rules of the
                                                    American Arbitration
                                                    Association ("AAA") and,
                                                    where appropriate, the
                                                    AAA&rsquo;s Supplementary
                                                    Procedures for Consumer
                                                    Related Disputes ("AAA
                                                    Consumer Rules"), both of
                                                    which are available at the
                                                    AAA website
                                                    <a
                                                      href="http://www.adr.org"
                                                      target="_blank"
                                                      rel="noopener noreferrer"
                                                      data-custom-class="link"
                                                      >www.adr.org</a
                                                    >. Your arbitration fees and
                                                    your share of arbitrator
                                                    compensation shall be
                                                    governed by the AAA Consumer
                                                    Rules and, where
                                                    appropriate, limited by the
                                                    AAA Consumer Rules.&nbsp;The
                                                    arbitration may be conducted
                                                    in person, through the
                                                    submission of documents, by
                                                    phone, or online. The
                                                    arbitrator will make a
                                                    decision in writing, but
                                                    need not provide a statement
                                                    of reasons unless requested
                                                    by either Party. The
                                                    arbitrator must follow
                                                    applicable law, and any
                                                    award may be challenged if
                                                    the arbitrator fails to do
                                                    so. Except where otherwise
                                                    required by the applicable
                                                    AAA rules or applicable law,
                                                    the arbitration will take
                                                    place in United States,
                                                    California. Except as
                                                    otherwise provided herein,
                                                    the Parties may litigate in
                                                    court to compel arbitration,
                                                    stay proceedings pending
                                                    arbitration, or to confirm,
                                                    modify, vacate, or enter
                                                    judgment on the award
                                                    entered by the arbitrator.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    If for any reason, a Dispute
                                                    proceeds in court rather
                                                    than arbitration, the
                                                    Dispute shall be commenced
                                                    or prosecuted in the state
                                                    and federal
                                                    courts&nbsp;located in Los
                                                    Angeles, California, and the
                                                    Parties hereby consent to,
                                                    and waive all defenses of
                                                    lack of personal
                                                    jurisdiction, and forum non
                                                    conveniens with respect to
                                                    venue and jurisdiction in
                                                    such state and federal
                                                    courts. Application of the
                                                    United Nations Convention on
                                                    Contracts for the
                                                    International Sale of Goods
                                                    and the Uniform Computer
                                                    Information Transaction Act
                                                    (UCITA) are excluded from
                                                    these Terms of Service.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    In no event shall any
                                                    Dispute brought by either
                                                    Party related in any way to
                                                    the Site be commenced more
                                                    than one (1) years after the
                                                    cause of action arose. If
                                                    this provision is found to
                                                    be illegal or unenforceable,
                                                    then neither Party will
                                                    elect to arbitrate any
                                                    Dispute falling within that
                                                    portion of this provision
                                                    found to be illegal or
                                                    unenforceable and such
                                                    Dispute shall be decided by
                                                    a court of competent
                                                    jurisdiction within the
                                                    courts listed for
                                                    jurisdiction above, and the
                                                    Parties agree to submit to
                                                    the personal jurisdiction of
                                                    that court.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_2">
                                                    <strong
                                                      >Restrictions</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    The Parties agree that any
                                                    arbitration shall be limited
                                                    to the Dispute between the
                                                    Parties individually. To the
                                                    full extent permitted by
                                                    law, (a) no arbitration
                                                    shall be joined with any
                                                    other proceeding; (b) there
                                                    is no right or authority for
                                                    any Dispute to be arbitrated
                                                    on a class-action basis or
                                                    to utilize class action
                                                    procedures; and (c) there is
                                                    no right or authority for
                                                    any Dispute to be brought in
                                                    a purported representative
                                                    capacity on behalf of the
                                                    general public or any other
                                                    persons.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_2">
                                                    <strong
                                                      >Exceptions to Informal
                                                      Negotiations and
                                                      Arbitration</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    The Parties agree that the
                                                    following Disputes are not
                                                    subject to the above
                                                    provisions concerning
                                                    informal negotiations and
                                                    binding arbitration: (a) any
                                                    Disputes seeking to enforce
                                                    or protect, or concerning
                                                    the validity of, any of the
                                                    intellectual property rights
                                                    of a Party; (b) any Dispute
                                                    related to, or arising from,
                                                    allegations of theft,
                                                    piracy, invasion of privacy,
                                                    or unauthorized use; and (c)
                                                    any claim for injunctive
                                                    relief. If this provision is
                                                    found to be illegal or
                                                    unenforceable, then neither
                                                    Party will elect to
                                                    arbitrate any Dispute
                                                    falling within that portion
                                                    of this provision found to
                                                    be illegal or unenforceable
                                                    and such Dispute shall be
                                                    decided by a court of
                                                    competent jurisdiction
                                                    within the courts listed for
                                                    jurisdiction above, and the
                                                    Parties agree to submit to
                                                    the personal jurisdiction of
                                                    that court.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >23. CORRECTIONS</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    There may be information on
                                                    the Site that contains
                                                    typographical errors,
                                                    inaccuracies, or omissions,
                                                    including descriptions,
                                                    pricing, availability, and
                                                    various other information.
                                                    We reserve the right to
                                                    correct any errors,
                                                    inaccuracies, or omissions
                                                    and to change or update the
                                                    information on the Site at
                                                    any time, without prior
                                                    notice.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >24. DISCLAIMER</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    THE SITE IS PROVIDED ON AN
                                                    AS-IS AND AS-AVAILABLE
                                                    BASIS. YOU AGREE THAT YOUR
                                                    USE OF THE SITE AND OUR
                                                    SERVICES WILL BE AT YOUR
                                                    SOLE RISK. TO THE FULLEST
                                                    EXTENT PERMITTED BY LAW, WE
                                                    DISCLAIM ALL WARRANTIES,
                                                    EXPRESS OR IMPLIED, IN
                                                    CONNECTION WITH THE SITE AND
                                                    YOUR USE THEREOF, INCLUDING,
                                                    WITHOUT LIMITATION, THE
                                                    IMPLIED WARRANTIES OF
                                                    MERCHANTABILITY, FITNESS FOR
                                                    A PARTICULAR PURPOSE, AND
                                                    NON-INFRINGEMENT. WE MAKE NO
                                                    WARRANTIES OR
                                                    REPRESENTATIONS ABOUT THE
                                                    ACCURACY OR COMPLETENESS OF
                                                    THE SITE&rsquo;S CONTENT OR
                                                    THE CONTENT OF ANY WEBSITES
                                                    LINKED TO THE SITE AND WE
                                                    WILL ASSUME NO LIABILITY OR
                                                    RESPONSIBILITY FOR ANY (1)
                                                    ERRORS, MISTAKES, OR
                                                    INACCURACIES OF CONTENT AND
                                                    MATERIALS, (2) PERSONAL
                                                    INJURY OR PROPERTY DAMAGE,
                                                    OF ANY NATURE WHATSOEVER,
                                                    RESULTING FROM YOUR ACCESS
                                                    TO AND USE OF THE SITE, (3)
                                                    ANY UNAUTHORIZED ACCESS TO
                                                    OR USE OF OUR SECURE SERVERS
                                                    AND/OR ANY AND ALL PERSONAL
                                                    INFORMATION AND/OR FINANCIAL
                                                    INFORMATION STORED THEREIN,
                                                    (4) ANY INTERRUPTION OR
                                                    CESSATION OF TRANSMISSION TO
                                                    OR FROM THE SITE, (5) ANY
                                                    BUGS, VIRUSES, TROJAN
                                                    HORSES, OR THE LIKE WHICH
                                                    MAY BE TRANSMITTED TO OR
                                                    THROUGH THE SITE BY ANY
                                                    THIRD PARTY, AND/OR (6) ANY
                                                    ERRORS OR OMISSIONS IN ANY
                                                    CONTENT AND MATERIALS OR FOR
                                                    ANY LOSS OR DAMAGE OF ANY
                                                    KIND INCURRED AS A RESULT OF
                                                    THE USE OF ANY CONTENT
                                                    POSTED, TRANSMITTED, OR
                                                    OTHERWISE MADE AVAILABLE VIA
                                                    THE SITE. WE DO NOT WARRANT,
                                                    ENDORSE, GUARANTEE, OR
                                                    ASSUME RESPONSIBILITY FOR
                                                    ANY PRODUCT OR SERVICE
                                                    ADVERTISED OR OFFERED BY A
                                                    THIRD PARTY THROUGH THE
                                                    SITE, ANY HYPERLINKED
                                                    WEBSITE, OR ANY WEBSITE OR
                                                    MOBILE APPLICATION FEATURED
                                                    IN ANY BANNER OR OTHER
                                                    ADVERTISING, AND WE WILL NOT
                                                    BE A PARTY TO OR IN ANY WAY
                                                    BE RESPONSIBLE FOR
                                                    MONITORING ANY TRANSACTION
                                                    BETWEEN YOU AND ANY
                                                    THIRD-PARTY PROVIDERS OF
                                                    PRODUCTS OR SERVICES. AS
                                                    WITH THE PURCHASE OF A
                                                    PRODUCT OR SERVICE THROUGH
                                                    ANY MEDIUM OR IN ANY
                                                    ENVIRONMENT, YOU SHOULD USE
                                                    YOUR BEST JUDGMENT AND
                                                    EXERCISE CAUTION WHERE
                                                    APPROPRIATE.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >25. LIMITATIONS OF
                                                      LIABILITY</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    IN NO EVENT WILL WE OR OUR
                                                    DIRECTORS, EMPLOYEES, OR
                                                    AGENTS BE LIABLE TO YOU OR
                                                    ANY THIRD PARTY FOR ANY
                                                    DIRECT, INDIRECT,
                                                    CONSEQUENTIAL, EXEMPLARY,
                                                    INCIDENTAL, SPECIAL, OR
                                                    PUNITIVE DAMAGES, INCLUDING
                                                    LOST PROFIT, LOST REVENUE,
                                                    LOSS OF DATA, OR OTHER
                                                    DAMAGES ARISING FROM YOUR
                                                    USE OF THE SITE, EVEN IF WE
                                                    HAVE BEEN ADVISED OF THE
                                                    POSSIBILITY OF SUCH DAMAGES.
                                                    NOTWITHSTANDING&nbsp;ANYTHING
                                                    TO THE CONTRARY CONTAINED
                                                    HEREIN, OUR LIABILITY TO YOU
                                                    FOR ANY CAUSE WHATSOEVER AND
                                                    REGARDLESS OF THE FORM OF
                                                    THE ACTION, WILL AT ALL
                                                    TIMES BE LIMITED TO
                                                    &nbsp;THE LESSER OF THE
                                                    AMOUNT PAID, IF ANY, BY YOU
                                                    TO US DURING THE SIX (6)
                                                    MONTH PERIOD PRIOR TO ANY
                                                    CAUSE OF ACTION&nbsp;ARISING
                                                    OR $1,000.00 USD. CERTAIN US
                                                    STATE LAWS AND INTERNATIONAL
                                                    LAWS DO NOT ALLOW
                                                    LIMITATIONS ON IMPLIED
                                                    WARRANTIES OR THE EXCLUSION
                                                    OR LIMITATION OF CERTAIN
                                                    DAMAGES. IF THESE LAWS APPLY
                                                    TO YOU, SOME OR ALL OF THE
                                                    ABOVE DISCLAIMERS OR
                                                    LIMITATIONS MAY NOT APPLY TO
                                                    YOU, AND YOU MAY HAVE
                                                    ADDITIONAL RIGHTS.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >26.
                                                      INDEMNIFICATION</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    You agree to defend,
                                                    indemnify, and hold us
                                                    harmless, including our
                                                    subsidiaries, affiliates,
                                                    and all of our respective
                                                    officers, agents, partners,
                                                    and employees, from and
                                                    against any loss, damage,
                                                    liability, claim, or demand,
                                                    including reasonable
                                                    attorneys&rsquo; fees and
                                                    expenses, made by any third
                                                    party due to or arising out
                                                    of: (1) your
                                                    Contributions;&nbsp;(2) use
                                                    of the Site; (3) breach of
                                                    these Terms of Service; (4)
                                                    any breach of your
                                                    representations and
                                                    warranties set forth in
                                                    these Terms of Service; (5)
                                                    your violation of the rights
                                                    of a third party, including
                                                    but not limited to
                                                    intellectual property
                                                    rights; or (6) any overt
                                                    harmful act toward any other
                                                    user of the Site with whom
                                                    you connected via the Site.
                                                    Notwithstanding the
                                                    foregoing, we reserve the
                                                    right, at your expense, to
                                                    assume the exclusive defense
                                                    and control of any matter
                                                    for which you are required
                                                    to indemnify us, and you
                                                    agree to cooperate, at your
                                                    expense, with our defense of
                                                    such claims. We will use
                                                    reasonable efforts to notify
                                                    you of any such claim,
                                                    action, or proceeding which
                                                    is subject to this
                                                    indemnification upon
                                                    becoming aware of it.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >27. USER DATA</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    We will maintain certain
                                                    data that you transmit to
                                                    the Site for the purpose of
                                                    managing the performance of
                                                    the Site, as well as data
                                                    relating to your use of the
                                                    Site. Although we perform
                                                    regular routine backups of
                                                    data, you are solely
                                                    responsible for all data
                                                    that you transmit or that
                                                    relates to any activity you
                                                    have undertaken using the
                                                    Site. You agree that we
                                                    shall have no liability to
                                                    you for any loss or
                                                    corruption of any such data,
                                                    and you hereby waive any
                                                    right of action against us
                                                    arising from any such loss
                                                    or corruption of such data.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >28. ELECTRONIC
                                                      COMMUNICATIONS,
                                                      TRANSACTIONS, AND
                                                      SIGNATURES</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    Visiting the Site, sending
                                                    us emails, and completing
                                                    online forms constitute
                                                    electronic communications.
                                                    You consent to receive
                                                    electronic communications,
                                                    and you agree that all
                                                    agreements, notices,
                                                    disclosures, and other
                                                    communications we provide to
                                                    you electronically, via
                                                    email and on the Site,
                                                    satisfy any legal
                                                    requirement that such
                                                    communication be in writing.
                                                    YOU HEREBY AGREE TO THE USE
                                                    OF ELECTRONIC SIGNATURES,
                                                    CONTRACTS, ORDERS, AND OTHER
                                                    RECORDS, AND TO ELECTRONIC
                                                    DELIVERY OF NOTICES,
                                                    POLICIES, AND RECORDS OF
                                                    TRANSACTIONS INITIATED OR
                                                    COMPLETED BY US OR VIA THE
                                                    SITE. You hereby waive any
                                                    rights or requirements under
                                                    any statutes, regulations,
                                                    rules, ordinances, or other
                                                    laws in any jurisdiction
                                                    which require an original
                                                    signature or delivery or
                                                    retention of non-electronic
                                                    records, or to payments or
                                                    the granting of credits by
                                                    any means other than
                                                    electronic means.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >29. CALIFORNIA USERS AND
                                                      RESIDENTS</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    If any complaint with us is
                                                    not satisfactorily resolved,
                                                    you can contact the
                                                    Complaint Assistance Unit of
                                                    the Division of Consumer
                                                    Services of the California
                                                    Department of Consumer
                                                    Affairs in writing at 1625
                                                    North Market Blvd., Suite N
                                                    112, Sacramento, California
                                                    95834 or by telephone at
                                                    (800) 952-5210 or (916)
                                                    445-1254.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >30. MISCELLANEOUS</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    These Terms of Service and
                                                    any policies or operating
                                                    rules posted by us on the
                                                    Site or in respect to the
                                                    Site constitute the entire
                                                    agreement and understanding
                                                    between you and us. Our
                                                    failure to exercise or
                                                    enforce any right or
                                                    provision of these Terms of
                                                    Service shall not operate as
                                                    a waiver of such right or
                                                    provision. These Terms of
                                                    Service operate to the
                                                    fullest extent permissible
                                                    by law. We may assign any or
                                                    all of our rights and
                                                    obligations to others at any
                                                    time. We shall not be
                                                    responsible or liable for
                                                    any loss, damage, delay, or
                                                    failure to act caused by any
                                                    cause beyond our reasonable
                                                    control. If any provision or
                                                    part of a provision of these
                                                    Terms of Service is
                                                    determined to be unlawful,
                                                    void, or unenforceable, that
                                                    provision or part of the
                                                    provision is deemed
                                                    severable from these Terms
                                                    of Service and does not
                                                    affect the validity and
                                                    enforceability of any
                                                    remaining provisions. There
                                                    is no joint venture,
                                                    partnership, employment or
                                                    agency relationship created
                                                    between you and us as a
                                                    result of these Terms of
                                                    Service or use of the Site.
                                                    You agree that these Terms
                                                    of Service will not be
                                                    construed against us by
                                                    virtue of having drafted
                                                    them. You hereby waive any
                                                    and all defenses you may
                                                    have based on the electronic
                                                    form of these Terms of
                                                    Service and the lack of
                                                    signing by the parties
                                                    hereto to execute these
                                                    Terms of Service.
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    &nbsp;
                                                  </div>
                                                  <div
                                                    data-custom-class="heading_1">
                                                    <strong
                                                      >31. CONTACT US</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    In order to resolve a
                                                    complaint regarding the Site
                                                    or to receive further
                                                    information regarding use of
                                                    the Site, please contact us
                                                    at:
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    <strong>Jovie Inc</strong>
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    <strong
                                                      >1600 Vine St</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    <strong
                                                      >Los Angeles<strong
                                                        >, CA</strong
                                                      ><strong>
                                                        90028</strong
                                                      ></strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    <strong
                                                      >United States</strong
                                                    >
                                                  </div>
                                                  <div
                                                    data-custom-class="body_text">
                                                    <strong
                                                      >support@jov.ie</strong
                                                    >
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </TabPanel>
              </TabPanels>
            </div>
          </div>
        </div>
      </div>
    </main>
  </TabGroup>
</template>

<script>
import { ref } from 'vue';
import { TabGroup, Tab, TabList, TabPanel, TabPanels } from '@headlessui/vue';

import { marked } from 'marked';
const tabs = [
  { name: 'Privacy', href: '#', current: true },
  { name: 'Terms', href: '#', current: false },
];

const selectedTab = ref(0);

function changeTab(index) {
  selectedTab.value = index;
}
export default {
  components: {
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    Tab,
  },
  data() {
    return {
      tabs,
      selectedTab,
    };
  },
  props: {
    defaultTab: {
      type: Number,
      default: 0,
    },
  },
};
</script>
