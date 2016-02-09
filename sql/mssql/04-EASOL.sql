/* SETTING UP MAIN TABLES FOR EASOL SCHEMA */
IF NOT EXISTS (SELECT schema_name 
    FROM information_schema.schemata 
    WHERE schema_name = 'EASOL' )
BEGIN
    EXEC sp_executesql N'CREATE SCHEMA EASOL';
END



DROP TABLE IF EXISTS [EASOL].[DashboardConfiguration];

CREATE TABLE [EASOL].[DashboardConfiguration](
	[DashboardConfigurationId] [int] IDENTITY(1,1) NOT NULL,
	[RoleTypeId] [int] NOT NULL,
	[EducationOrganizationId] [int] NOT NULL,
	[LeftChartReportId] [int] NULL,
	[RightChartReportId] [int] NULL,
	[BottomTableReportId] [int] NULL,
	[CreatedBy] [int] NULL,
	[CreatedOn] [datetime] NULL,
	[UpdatedBy] [int] NULL,
	[UpdatedOn] [datetime] NULL,
 	PRIMARY KEY CLUSTERED 
	(
	[DashboardConfigurationId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);


DROP TABLE IF EXISTS [EASOL].[EmailLookup]
CREATE TABLE [EASOL].[EmailLookup](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[Email] [varchar](1023) NOT NULL,
	[HashedEmail] [varchar](1023) NOT NULL,
 	PRIMARY KEY CLUSTERED 
	(
	[id] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);



DROP TABLE IF EXISTS [EASOL].[Logs];


CREATE TABLE [EASOL].[Logs](
	[StaffUSI] [int] NULL,
	[DateTime] [datetime] NOT NULL,
	[IpAddress] [nvarchar](50) NOT NULL,
	[Description] [nvarchar](255) NOT NULL,
	[Controller] [nvarchar](75) NOT NULL,
	[Method] [nvarchar](75) NOT NULL,
	[Object] [nvarchar](75) NULL,
	[Data] [text] NULL
)


	DROP TABLE IF EXISTS [EASOL].[Report];


CREATE TABLE [EASOL].[Report](
	[ReportId] [int] IDENTITY(1,1) NOT NULL,
	[ReportName] [nvarchar](255) NOT NULL,
	[ReportCategoryId] [int] NULL,
	[CommandText] [nvarchar](max) NOT NULL,
	[ReportDisplayId] [int] NOT NULL,
	[CreatedBy] [int] NULL,
	[CreatedOn] [datetime] NULL,
	[UpdatedBy] [int] NULL,
	[UpdatedOn] [datetime] NULL,
	[SchoolId] [int] NOT NULL,
	[LabelX] [varchar](50) NULL,
	[LabelY] [varchar](50) NULL,
	PRIMARY KEY CLUSTERED 
	(
	[ReportId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);

DROP TABLE IF EXISTS  [EASOL].[ReportAccess];

CREATE TABLE [EASOL].[ReportAccess](
	[ReportAccessId] [int] IDENTITY(1,1) NOT NULL,
	[ReportId] [int] NOT NULL,
	[RoleTypeId] [int] NOT NULL,
	PRIMARY KEY CLUSTERED 
	(
	[ReportAccessId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
)


DROP TABLE IF EXISTS [EASOL].[ReportCategory];

CREATE TABLE [EASOL].[ReportCategory](
	[ReportCategoryId] [int] IDENTITY(1,1) NOT NULL,
	[ReportCategoryName] [nvarchar](255) NOT NULL,
	PRIMARY KEY CLUSTERED 
	(
	[ReportCategoryId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);


DROP TABLE IF EXISTS [EASOL].[ReportDisplay];
CREATE TABLE [EASOL].[ReportDisplay](
	[ReportDisplayId] [int] IDENTITY(1,1) NOT NULL,
	[DisplayName] [nvarchar](255) NOT NULL,
	PRIMARY KEY CLUSTERED 
	(
	[ReportDisplayId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);

--Need to have at top because of foreign KEY restraint
DROP TABLE IF EXISTS [EASOL].[StaffAuthentication];
DROP TABLE IF EXISTS [EASOL].[RoleType];

CREATE TABLE [EASOL].[RoleType](
	[RoleTypeId] [int] IDENTITY(1,1) NOT NULL,
	[RoleTypeName] [nvarchar](75) NOT NULL,
	PRIMARY KEY CLUSTERED 
	(
	[RoleTypeId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);

insert into [EASOL].[RoleType] ( roletypename ) values ( 'System Administrator'); 
insert into [EASOL].[RoleType] ( roletypename ) values ( 'Data Administrator'); 
insert into [EASOL].[RoleType] ( roletypename ) values ( 'School Administrator'); 
insert into [EASOL].[RoleType] ( roletypename ) values ( 'Educator'); 



DROP TABLE IF EXISTS [EASOL].[Schema];

CREATE TABLE [EASOL].[Schema](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[TableName] [nvarchar](255) NOT NULL,
	[TableType] [nvarchar](255) NOT NULL,
	[Display] [bit] NOT NULL,
	[Domain] [nvarchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);

-- Insert 423 entries into Schema
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationInterventionPrescriptionAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationNetworkAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationPeerAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'FeederSchoolAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffCohortAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffEducationOrganizationAssignmentAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffEducationOrganizationEmploymentAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffProgramAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffSchoolAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffSectionAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCohortAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCTEProgramAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentDisciplineIncidentAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentEducationOrganizationAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentInterventionAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentMigrantEducationProgramAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentParentAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentProgramAssociation','Association','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSchoolAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSectionAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSpecialEducationProgramAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentTitleIPartAProgramAssociation','Association','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AcademicSubjectDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AccommodationDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AccountCodeDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AchievementCategoryDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AdministrativeFundingControlDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentPeriodDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AttendanceEventCategoryDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'BehaviorDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CalendarEventDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ClassroomPositionDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CompetencyLevelDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ContinuationOfServicesReasonDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CredentialFieldDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Descriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DiagnosisDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisabilityDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EmploymentStatusDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EntryTypeDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ExitWithdrawTypeDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradeLevelDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradingPeriodDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GraduationPlanTypeDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LanguageDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LevelDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LevelOfEducationDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LimitedEnglishProficiencyDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PerformanceLevelDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramAssignmentDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramCharacteristicDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReasonExitedDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReporterDescriptionDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ResidencyStatusDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ResponsibilityDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolFoodServicesEligibilityDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SectionCharacteristicDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SeparationReasonDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ServiceDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SpecialEducationSettingDescriptor','Descriptor','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffClassificationDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCharacteristicDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TeachingCredentialDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'WeaponDescriptor','Descriptor','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AccountCode','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentFamilyIdentificationCode','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentIdentificationCode','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseIdentificationCode','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationIdentificationCode','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningStandardIdentificationCode','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostSecondaryEventPostSecondaryInstitutionIdentificationCode','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffIdentificationCode','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentIdentificationCode','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AcademicWeek','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Account','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AccountabilityRating','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Actual','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Assessment','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentContentStandard','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentContentStandardAuthor','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentFamily','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentFamilyAssessmentPeriod','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentFamilyContentStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentFamilyContentStandardAuthor','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentFamilyLanguage','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentItem','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentItemLearningStandard','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentLanguage','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentPerformanceLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentProgram','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentScore','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentSection','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'BellSchedule','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'BellScheduleMeetingTime','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Budget','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CalendarDate','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CalendarDateCalendarEvent','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ClassPeriod','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Cohort','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CohortProgram','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CompetencyObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ContractedStaff','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Course','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseCompetencyLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseLearningObjective','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseLearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseLevelCharacteristic','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseOffering','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseOfferingCurriculumUsed','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseTranscript','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseTranscriptAdditionalCredit','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseTranscriptExternalCourse','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineAction','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineActionDiscipline','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineActionDisciplineIncident','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineActionStaff','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineIncident','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineIncidentBehavior','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineIncidentWeapon','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EdFiException','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentAppropriateGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentAppropriateSex','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentAuthor','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentDerivativeSourceEducationContent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentDerivativeSourceLearningResourceMetadataURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentDerivativeSourceURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationContentLanguage','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganization','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationAddress','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationCategory','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationInstitutionTelephone','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationInternationalAddress','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationNetwork','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationServiceCenter','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Grade','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradebookEntry','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradebookEntryLearningObjective','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradebookEntryLearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradingPeriod','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GraduationPlan','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GraduationPlanCreditsByCourse','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GraduationPlanCreditsByCourseCourse','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GraduationPlanCreditsBySubject','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Intervention','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionAppropriateGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionAppropriateSex','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionDiagnosis','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionEducationContent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionInterventionPrescription','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionLearningResourceMetadataURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionMeetingTime','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPopulationServed','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescription','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionAppropriateGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionAppropriateSex','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionDiagnosis','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionEducationContent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionLearningResourceMetadataURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionPopulationServed','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionPrescriptionURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStaff','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudy','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyAppropriateGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyAppropriateSex','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyEducationContent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyInterventionEffectiveness','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyLearningResourceMetadataURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyPopulationServed','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyStateAbbreviation','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionStudyURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionURI','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningObjectiveContentStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningObjectiveContentStandardAuthor','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningObjectiveLearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningStandardContentStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningStandardContentStandardAuthor','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LearningStandardPrerequisiteLearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LeaveEvent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LevelDescriptorGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LocalEducationAgency','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LocalEducationAgencyAccountability','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LocalEducationAgencyFederalFunds','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Location','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ObjectiveAssessment','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ObjectiveAssessmentAssessmentItem','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ObjectiveAssessmentLearningObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ObjectiveAssessmentLearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ObjectiveAssessmentPerformanceLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'OpenStaffPosition','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'OpenStaffPositionAcademicSubject','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'OpenStaffPositionInstructionalGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Parent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ParentAddress','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ParentElectronicMail','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ParentIdentificationDocument','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ParentInternationalAddress','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ParentOtherName','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ParentTelephone','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Payroll','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostSecondaryEvent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostSecondaryEventPostSecondaryInstitution','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Program','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramCharacteristic','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramLearningObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramLearningStandard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramService','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReportCard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReportCardGrade','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReportCardStudentCompetencyObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReportCardStudentLearningObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RestraintEvent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RestraintEventProgram','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RestraintEventReason','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'School','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolCategory','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Section','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SectionAttendanceTakenEvent','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SectionCharacteristic','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SectionProgram','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Session','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SessionAcademicWeek','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SessionGradingPeriod','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Staff','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffAddress','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffCredential','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffElectronicMail','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffIdentificationDocument','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffInternationalAddress','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffLanguage','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffLanguageUse','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffOtherName','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffRace','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffSchoolAssociationAcademicSubject','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffSchoolAssociationGradeLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffTelephone','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffVisa','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StateEducationAgency','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StateEducationAgencyAccountability','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StateEducationAgencyFederalFunds','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'Student','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAcademicRecord','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAcademicRecordAcademicHonor','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAcademicRecordClassRanking','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAcademicRecordDiploma','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAcademicRecordRecognition','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAcademicRecordReportCard','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAddress','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessment','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentAccommodation','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentItem','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentPerformanceLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentScoreResult','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentStudentObjectiveAssessment','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentStudentObjectiveAssessmentPerformanceLevel','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentAssessmentStudentObjectiveAssessmentScoreResult','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCharacteristic','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCohortAssociationSection','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCohortYear','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCompetencyObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCTEProgramAssociationCTEProgram','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentDisability','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentDisciplineIncidentAssociationBehavior','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentElectronicMail','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentGradebookEntry','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentIdentificationDocument','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentIndicator','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentInternationalAddress','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentInterventionAssociationInterventionEffectiveness','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentInterventionAttendanceEvent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentLanguage','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentLanguageUse','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentLearningObjective','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentLearningStyle','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentOtherName','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentProgramAssociationService','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentProgramAttendanceEvent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentProgramParticipation','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentProgramParticipationProgramCharacteristic','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentRace','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSchoolAssociationEducationPlan','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSchoolAttendanceEvent','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSectionAttendanceEvent','Primary','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentSpecialEducationProgramAssociationServiceProvider','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentTelephone','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentVisa','Primary','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AcademicHonorCategoryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AcademicSubjectType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AccommodationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AchievementCategoryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AdditionalCreditType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AddressType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AdministrationEnvironmentType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AdministrativeFundingControlType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentCategoryType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentIdentificationSystemType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentItemCategoryType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentItemResultType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AssessmentReportingMethodType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'AttendanceEventCategoryType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'BehaviorType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CalendarEventType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CareerPathwayType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CharterStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CitizenshipStatusType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ClassroomPositionType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CohortScopeType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CohortType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CohortYearType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ContentClassType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ContinuationOfServicesReasonType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CostRateType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CountryCodeType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CountryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseAttemptResultType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseCodeSystemType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseDefinedByType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseGPAApplicabilityType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseLevelCharacteristicType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CourseRepeatCodeType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CredentialType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CreditType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'CurriculumUsedType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DeliveryMethodType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DiagnosisType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DiplomaLevelType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DiplomaType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisabilityCategoryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisabilityType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineActionLengthDifferenceReasonType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'DisciplineType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationalEnvironmentType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationCategoryType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationOrganizationIdentificationSystemType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EducationPlanType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ElectronicMailType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EmploymentStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EntryGradeLevelReasonType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EntryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'EventCircumstanceType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ExitWithdrawType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradebookEntryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradeLevelType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradeType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GradingPeriodType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GraduationPlanType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'GunFreeSchoolsActReportingStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'IdentificationDocumentUseType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'IncidentLocationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InstitutionTelephoneNumberType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'IntegratedTechnologyStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InteractivityStyleType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InternetAccessType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionClassType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'InterventionEffectivenessRatingType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LanguageType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LanguageUseType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LeaveEventCategoryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LevelOfEducationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LimitedEnglishProficiencyType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'LocalEducationAgencyCategoryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'MagnetSpecialProgramEmphasisSchoolType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'MediumOfInstructionType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'MeetingDayType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'MethodCreditEarnedType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'NetworkPurposeType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'OldEthnicityType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'OperationalStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'OtherNameType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PerformanceBaseConversionType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PersonalInformationVerificationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PopulationServedType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostingResultType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostSecondaryEventCategoryType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PostSecondaryInstitutionLevelType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramAssignmentType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramCharacteristicType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramSponsorType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ProgramType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'PublicationStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RaceType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReasonExitedType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReasonNotTestedType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RecognitionType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RelationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RepeatIdentifierType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ReporterDescriptionType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ResidencyStatusType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ResponseIndicatorType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ResponsibilityType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RestraintEventReasonType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'ResultDatatypeType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'RetestIndicatorType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolCategoryType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolChoiceImplementStatusType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolFoodServicesEligibilityType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SchoolYearType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SectionCharacteristicType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SeparationReasonType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SeparationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SexType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'SpecialEducationSettingType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffClassificationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StaffIdentificationSystemType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StateAbbreviationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentCharacteristicType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentIdentificationSystemType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'StudentParticipationCodeType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TeachingCredentialBasisType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TeachingCredentialType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TelephoneNumberType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TermType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TitleIPartAParticipantType','Type','1',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'TitleIPartASchoolDesignationType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'VisaType','Type','0',NULL); 
insert into [EASOL].[SCHEMA] ( tableName, tabletype, display, domain ) values ( 'WeaponType','Type','0',NULL); 

DROP TABLE IF EXISTS [EASOL].[SchoolConfiguration];


CREATE TABLE [EASOL].[SchoolConfiguration](
	[EducationOrganizationId] [int] NOT NULL,
	[Key] [nvarchar](255) NOT NULL,
	[Value] [nvarchar](max) NULL,
	PRIMARY KEY CLUSTERED 
	(
	[EducationOrganizationId] ASC,
	[Key] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);



CREATE TABLE [EASOL].[StaffAuthentication](
	[StaffUSI] [int] NOT NULL,
	[Password] [nvarchar](40) NOT NULL,
	[LastModifiedDate] [datetime] NOT NULL,
	[CreateDate] [datetime] NOT NULL,
	[RoleId] [int] NULL,
	[Locked] [bit] NULL,
	[GoogleAuth] [bit] NULL DEFAULT ((0))
);



ALTER TABLE [EASOL].[StaffAuthentication]  WITH CHECK ADD FOREIGN KEY([RoleId])
REFERENCES [EASOL].[RoleType] ([RoleTypeId])
ON DELETE SET NULL


ALTER TABLE [EASOL].[StaffAuthentication]  WITH CHECK ADD FOREIGN KEY([StaffUSI])
REFERENCES [edfi].[Staff] ([StaffUSI])
ON DELETE CASCADE
GO



DROP TABLE IF EXISTS [EASOL].[SystemConfiguration];

CREATE TABLE [EASOL].[SystemConfiguration](
	[SystemConfigurationId] [int] IDENTITY(1,1) NOT NULL,
	[Key] [nvarchar](255) NOT NULL,
	[Value] [nvarchar](max) NULL,
	[CreatedBy] [int] NULL,
	[CreatedOn] [datetime] NULL,
	[UpdatedBy] [int] NULL,
	[UpdatedOn] [datetime] NULL,
	PRIMARY KEY CLUSTERED 
	(
	[SystemConfigurationId] ASC
	)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON)
);

SET QUOTED_IDENTIFIER ON


CREATE TABLE [EASOL].[ReportFilter](
	[ReportFilterId] [int] IDENTITY(1,1) NOT NULL,
	[ReportId] [int] NOT NULL,
	[DisplayName] [nvarchar](75) NULL,
	[FieldName] [nvarchar](75) NULL,
	[FilterType] [nvarchar](75) NULL,
	[FilterOptions] [nvarchar](max) NULL,
	[DefaultValue] [nvarchar](75) NULL,
PRIMARY KEY CLUSTERED 
(
	[ReportFilterId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]



SET ANSI_NULLS ON


CREATE TABLE [EASOL].[ReportLink](
	[ReportLinkId] [int] IDENTITY(1,1) NOT NULL,
	[ReportId] [int] NOT NULL,
	[URL] [nvarchar](120) NULL,
	[ColumnNo] [nvarchar](75) NULL
PRIMARY KEY CLUSTERED 
(
	[ReportLinkId] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]




CREATE TABLE [EASOL].[Logs](
	[LogId] [int] IDENTITY(1,1) NOT NULL,
	[StaffUSI] [int] NOT NULL,
	[DateTime] [datetime] NOT NULL,
	[IpAddress] [nvarchar](16) NOT NULL,
	[Description] [nvarchar](255) NOT NULL,
	[Controller] [nvarchar](75) NOT NULL,
	[Method] [nvarchar](75) NOT NULL,
	[Object] [nvarchar](75) NULL,
	[Data] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


/* oAuth2 Implementation */
CREATE TABLE EASOL.oauth_clients (client_id VARCHAR(80) NOT NULL, client_secret VARCHAR(80), redirect_uri VARCHAR(2000) NOT NULL, grant_types VARCHAR(80), scope VARCHAR(100), user_id VARCHAR(80), CONSTRAINT clients_client_id_pk PRIMARY KEY (client_id));
CREATE TABLE EASOL.oauth_access_tokens (access_token VARCHAR(40) NOT NULL, client_id VARCHAR(80) NOT NULL, user_id VARCHAR(255), expires DATETIME NOT NULL, scope VARCHAR(2000), CONSTRAINT access_token_pk PRIMARY KEY (access_token));
CREATE TABLE EASOL.oauth_authorization_codes (authorization_code VARCHAR(40) NOT NULL, client_id VARCHAR(80) NOT NULL, user_id VARCHAR(255), redirect_uri VARCHAR(2000), expires TIMESTAMP NOT NULL, scope VARCHAR(2000), CONSTRAINT auth_code_pk PRIMARY KEY (authorization_code));
CREATE TABLE EASOL.oauth_refresh_tokens (refresh_token VARCHAR(40) NOT NULL, client_id VARCHAR(80) NOT NULL, user_id VARCHAR(255), expires TIMESTAMP NOT NULL, scope VARCHAR(2000), CONSTRAINT refresh_token_pk PRIMARY KEY (refresh_token));
CREATE TABLE EASOL.oauth_users (username VARCHAR(255) NOT NULL, password VARCHAR(2000), first_name VARCHAR(255), last_name VARCHAR(255), CONSTRAINT username_pk PRIMARY KEY (username));
CREATE TABLE EASOL.oauth_scopes (scope TEXT, is_default BIT);
CREATE TABLE EASOL.oauth_jwt (client_id VARCHAR(80) NOT NULL, subject VARCHAR(80), public_key VARCHAR(2000), CONSTRAINT jwt_client_id_pk PRIMARY KEY (client_id));