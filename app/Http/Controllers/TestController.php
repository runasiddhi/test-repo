<?php namespace App\Http\Controllers;

use AcademyHQ\API\Common;

class TestController extends Controller {

	private $fatory;

	public function __construct(){

		$credentials = new \AcademyHQ\API\Common\Credentials(
	        new \AcademyHQ\API\ValueObjects\AppID('0PO6J17JBYZ7T7JJ3X82'),
	        new \AcademyHQ\API\ValueObjects\SecretKey('uV3F3YluFpal1cknvbcGwgjvx4QpvB+leU8dUj2n')
	    );

	    $this->factory = new \AcademyHQ\API\Repository\Factory($credentials);
	}

	public function create_member() {

	    $member_repository = $this->factory->get_member_repository();

    	$member_id = $member_repository->create(
		        \AcademyHQ\API\ValueObjects\Name::fromNative("Sajana", "Maharjan"),
		        new \AcademyHQ\API\ValueObjects\Username("sajana"),
		        new \AcademyHQ\API\ValueObjects\Email("sajana@xyz.com"),
		        new \AcademyHQ\API\ValueObjects\Password("sajana")
		    );

    	$member = $member_repository->get(new \AcademyHQ\API\ValueObjects\MemberID($member_id));

    	echo "Member '".$member->first_name." ".$member->last_name."' has been created";
	}

	public function create_enrolment() {

		$enrolment_repository = $this->factory->get_enrolment_repository(); 

		$enrolment_id = $enrolment_repository->create(
	        new \AcademyHQ\API\ValueObjects\MemberID('321711'),
	        new \AcademyHQ\API\ValueObjects\LicenseID('44773')
	    );

	    $enrolment = $enrolment_repository->get(new \AcademyHQ\API\ValueObjects\EnrolmentID($enrolment_id));

	    echo "Enrolment in course ".$enrolment->course." has been created";
	}
}