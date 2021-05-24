<div class="menu_header">
		<div class="adminNavV1">
			<div class="contentContainer">
				<div class="contentInnerContainer">
					<div class="adminNavContent">
						<div class="mainNav">
							<div class="leftContainer">
								<div class="navLogoContainer">
									<a class="navLogo" href="{{url('/admin')}}">Logo Here
									</a>
									<a class="navLogo mobile" href="{{url('/admin')}}">Logo Here
									</a>
								</div>
								<div class="boardDropdown active">
									<div class="dropdownContainer">
										<div class="selection split" id="select_board">
											@foreach($get_tag as $key => $value)
											
												<a class="option" href="{{URL::to('/admin/board/'.$value->tag_url)}}">
													<div class="optionContent">
														<div>{!! $value->tag_name !!}</div>
														
													</div>
												</a>
												<div class="icon-chevron-down"></div>
												<input type="hidden" name="get_tag_id" id="get_tag_id" value="{!! $value->tag_id !!}">
											
											@endforeach
											
											
											
										</div>

										
										<?php  

										// $dem1 =0;
										// $count =[];
										// foreach($all_tag as $key => $value){
										// 	if(isset($count_post[$dem1]->post_count)){
										// 		$count[] = $count_post[$dem1]->post_count;
										// 	}else{
										// 		$count[] = 0;
										// 	}
										// 	$dem1++;
										// }
										// $dem2 =0;
										$dem2 = 0;

										?>
										<div class="dropdown" style="display: none;">
											@foreach($all_tag as $key => $value)
											<?php 
											  if($dem2 < 99){
											?>
											<a class="option" href="{{URL::to('/admin/board/'.$value->tag_url)}}">
												<div class="optionContent">
													<div>{!! $value->tag_name !!}</div>
													<div class="uppercaseHeader count">
														<?php  
														foreach($count_post as $key => $row){
															if($value->tag_id == $row->tag_id){
																echo $row->post_count;
															}else{
																echo "0";
															}
														}
														?>
													</div>
												</div>
											</a>
										    <?php 
										        $dem2 ++;
									        	}
									        	else{
									        		echo "<span>99+</span>";
									        	}
										    ?>
											
											@endforeach
										</div>
										
									</div>
								</div>
								<!-- <div class="boardDropdown">

									<a class="left onlyOneBoard active" href="{{url('/admin')}}">feedback_board</a>
								</div> -->
								<a class="linkContainer" href="/test_ci/user">People</a>
								<a class="linkContainer" href="/admin/changelog">Changelog</a>
							</div>
							<div class="rightContainer">
								<button class="changelogIcon" data-canny-changelog="true" style="position: relative;">
									<div class="icon-bolt">

									</div>
									<div class="Canny_BadgeContainer">
										<div class="Canny_Badge">

										</div>
									</div>
								</button>
								<div class="notificationsMenu">
									<div class="menu iconButton">
										<span class="icon icon-bell"></span>
									</div>
								</div>
								<div class="adminNavAccountMenu">
									<div class="userProfile">
										<div class="userAvatar">
											<div class="missingAvatar" style="background-color: rgb(187, 204, 204);">j</div>
										</div>

									</div>
									<div class="accountMenu" style="display: none;">
										<div class="arrow"></div>
										<div class="menuItems">
											<div class="section">
												<a class="menuItem" href="/admin/settings/account">
													<div class="icon icon-gear"></div>
													<div class="itemName">Settings</div>
												</a>
												<a class="menuItem" href="https://developers.canny.io/install" target="_blank">
													<div class="icon icon-book"></div>
													<div class="itemName">Docs</div>
												</a>
												<a class="menuItem" href="https://help.canny.io/" target="_blank">
													<div class="icon icon-help"></div>
													<div class="itemName">Help Center</div>
												</a>
												<a class="menuItem" href="https://feedback.canny.io" target="_blank">
													<div class="icon icon-comment-solid"></div>
													<div class="itemName">Canny Feedback</div>
												</a>
											</div>
											<div class="betaButton">
												<div class="icon icon-star"></div>
												<div class="textContainer">
													<div class="bigText">Try Canny 2.0!</div>
													<div class="smallText">Switch back anytime</div>
												</div>
											</div>
											<div class="companies section">
												<a class="menuItem" href="https://canny.io/register">
													<div class="icon icon-plus"></div>
													<div class="itemName">New Company</div>
												</a>
											</div>
											<div class="section">
												<div class="menuItem">
													<div class="icon icon-logout"></div>
													<div class="itemName">Logout</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="adminSecondaryNav">
							<div class="navMenu">
								<div class="section">
									<a class="link activeLink" href="/admin/board/feedbackboard">Posts</a>
									<a class="link" href="/admin/board/feedbackboard/settings">Settings</a>
								</div>
								<div class="section">
									<a class="link toPublic" href="/feedbackboard">Public&nbsp;View&nbsp;↗</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>