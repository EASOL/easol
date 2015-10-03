IF NOT EXISTS (SELECT schema_name 
    FROM information_schema.schemata 
    WHERE schema_name = 'edfi' )
BEGIN
    EXEC sp_executesql N'CREATE SCHEMA edfi;';
END

-- ----------------------------
-- Table structure for AcademicHonorCategoryType
-- ----------------------------

CREATE TABLE [edfi].[AcademicHonorCategoryType] (
[AcademicHonorCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AcademicHonorCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AcademicHonorCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AcademicHonorCategoryType_ShortDescription] ON [edfi].[AcademicHonorCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AcademicHonorCategoryType] ON [edfi].[AcademicHonorCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AcademicSubjectDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AcademicSubjectDescriptor] (
[AcademicSubjectDescriptorId] int NOT NULL ,
[AcademicSubjectTypeId] int NOT NULL ,
PRIMARY KEY ([AcademicSubjectDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AcademicSubjectDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AcademicSubjectType
-- ----------------------------

CREATE TABLE [edfi].[AcademicSubjectType] (
[AcademicSubjectTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AcademicSubjectTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AcademicSubjectType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AcademicSubjectType_ShortDescription] ON [edfi].[AcademicSubjectType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AcademicSubjectType] ON [edfi].[AcademicSubjectType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AcademicWeek
-- ----------------------------

CREATE TABLE [edfi].[AcademicWeek] (
[WeekIdentifier] nvarchar(80) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NOT NULL ,
[TotalInstructionalDays] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([WeekIdentifier], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table AcademicWeek
-- ----------------------------
CREATE UNIQUE INDEX [GUID_AcademicWeek] ON [edfi].[AcademicWeek]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AccommodationDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AccommodationDescriptor] (
[AccommodationDescriptorId] int NOT NULL ,
[AccommodationTypeId] int NULL ,
PRIMARY KEY ([AccommodationDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AccommodationDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AccommodationType
-- ----------------------------

CREATE TABLE [edfi].[AccommodationType] (
[AccommodationTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[CodeValue] nvarchar(50) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AccommodationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AccommodationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AccommodationType_ShortDescription] ON [edfi].[AccommodationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AccommodationType] ON [edfi].[AccommodationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Account
-- ----------------------------

CREATE TABLE [edfi].[Account] (
[EducationOrganizationId] int NOT NULL ,
[AccountNumber] nvarchar(50) NOT NULL ,
[FiscalYear] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear])
)


GO

-- ----------------------------
-- Indexes structure for table Account
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Account] ON [edfi].[Account]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AccountabilityRating
-- ----------------------------

CREATE TABLE [edfi].[AccountabilityRating] (
[EducationOrganizationId] int NOT NULL ,
[RatingTitle] nvarchar(60) NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[Rating] nvarchar(35) NOT NULL ,
[RatingDate] date NULL ,
[RatingOrganization] nvarchar(35) NULL ,
[RatingProgram] nvarchar(30) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [RatingTitle], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table AccountabilityRating
-- ----------------------------
CREATE UNIQUE INDEX [GUID_AccountabilityRating] ON [edfi].[AccountabilityRating]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AccountCode
-- ----------------------------

CREATE TABLE [edfi].[AccountCode] (
[EducationOrganizationId] int NOT NULL ,
[AccountNumber] nvarchar(50) NOT NULL ,
[FiscalYear] int NOT NULL ,
[AccountCodeDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear], [AccountCodeDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AccountCode
-- ----------------------------

-- ----------------------------
-- Table structure for AccountCodeDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AccountCodeDescriptor] (
[AccountCodeDescriptorId] int NOT NULL ,
[AccountCodeCategory] nvarchar(20) NOT NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
PRIMARY KEY ([AccountCodeDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AccountCodeDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AchievementCategoryDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AchievementCategoryDescriptor] (
[AchievementCategoryDescriptorId] int NOT NULL ,
[AchievementCategoryTypeId] int NULL ,
PRIMARY KEY ([AchievementCategoryDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AchievementCategoryDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AchievementCategoryType
-- ----------------------------

CREATE TABLE [edfi].[AchievementCategoryType] (
[AchievementCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AchievementCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AchievementCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AchievementCategoryType_ShortDescription] ON [edfi].[AchievementCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AchievementCategoryType] ON [edfi].[AchievementCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Actual
-- ----------------------------

CREATE TABLE [edfi].[Actual] (
[EducationOrganizationId] int NOT NULL ,
[AccountNumber] nvarchar(50) NOT NULL ,
[FiscalYear] int NOT NULL ,
[AsOfDate] date NOT NULL ,
[AmountToDate] money NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear], [AsOfDate])
)


GO

-- ----------------------------
-- Indexes structure for table Actual
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Actual] ON [edfi].[Actual]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AdditionalCreditType
-- ----------------------------

CREATE TABLE [edfi].[AdditionalCreditType] (
[AdditionalCreditTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AdditionalCreditTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AdditionalCreditType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AdditionalCreditType_ShortDescription] ON [edfi].[AdditionalCreditType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AdditionalCreditType] ON [edfi].[AdditionalCreditType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AddressType
-- ----------------------------

CREATE TABLE [edfi].[AddressType] (
[AddressTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AddressType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AddressType_ShortDescription] ON [edfi].[AddressType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AddressType] ON [edfi].[AddressType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AdministrationEnvironmentType
-- ----------------------------

CREATE TABLE [edfi].[AdministrationEnvironmentType] (
[AdministrationEnvironmentTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AdministrationEnvironmentTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AdministrationEnvironmentType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AdministrationEnvironmentType_ShortDescription] ON [edfi].[AdministrationEnvironmentType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AdministrationEnvironmentType] ON [edfi].[AdministrationEnvironmentType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AdministrativeFundingControlDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AdministrativeFundingControlDescriptor] (
[AdministrativeFundingControlDescriptorId] int NOT NULL ,
[AdministrativeFundingControlTypeId] int NULL ,
PRIMARY KEY ([AdministrativeFundingControlDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AdministrativeFundingControlDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AdministrativeFundingControlType
-- ----------------------------

CREATE TABLE [edfi].[AdministrativeFundingControlType] (
[AdministrativeFundingControlTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AdministrativeFundingControlTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AdministrativeFundingControlType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AdministrativeFundingControlType_ShortDescription] ON [edfi].[AdministrativeFundingControlType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AdministrativeFundingControlType] ON [edfi].[AdministrativeFundingControlType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Assessment
-- ----------------------------

CREATE TABLE [edfi].[Assessment] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AssessmentCategoryTypeId] int NULL ,
[LowestAssessedGradeLevelDescriptorId] int NULL ,
[AssessmentForm] nvarchar(60) NULL ,
[RevisionDate] date NULL ,
[MaxRawScore] int NULL ,
[Nomenclature] nvarchar(35) NULL ,
[AssessmentPeriodDescriptorId] int NULL ,
[AssessmentFamilyTitle] nvarchar(60) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version])
)


GO

-- ----------------------------
-- Indexes structure for table Assessment
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Assessment] ON [edfi].[Assessment]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentCategoryType
-- ----------------------------

CREATE TABLE [edfi].[AssessmentCategoryType] (
[AssessmentCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AssessmentCategoryType_ShortDescription] ON [edfi].[AssessmentCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AssessmentCategoryType] ON [edfi].[AssessmentCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentContentStandard
-- ----------------------------

CREATE TABLE [edfi].[AssessmentContentStandard] (
[AssessmentVersion] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Title] nvarchar(75) NOT NULL ,
[Version] nvarchar(50) NULL ,
[URI] nvarchar(255) NULL ,
[PublicationDate] date NULL ,
[PublicationYear] smallint NULL ,
[PublicationStatusTypeId] int NULL ,
[MandatingEducationOrganizationId] int NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentVersion], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentContentStandard
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentContentStandardAuthor
-- ----------------------------

CREATE TABLE [edfi].[AssessmentContentStandardAuthor] (
[AssessmentVersion] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Author] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentVersion], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Author])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentContentStandardAuthor
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentFamily
-- ----------------------------

CREATE TABLE [edfi].[AssessmentFamily] (
[AssessmentFamilyTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NULL ,
[AssessedGradeLevelDescriptorId] int NULL ,
[Version] int NULL ,
[AssessmentCategoryTypeId] int NULL ,
[LowestAssessedGradeLevelDescriptorId] int NULL ,
[RevisionDate] date NULL ,
[Nomenclature] nvarchar(35) NULL ,
[ParentAssessmentFamilyTitle] nvarchar(60) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentFamilyTitle])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentFamily
-- ----------------------------
CREATE UNIQUE INDEX [GUID_AssessmentFamily] ON [edfi].[AssessmentFamily]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentFamilyAssessmentPeriod
-- ----------------------------

CREATE TABLE [edfi].[AssessmentFamilyAssessmentPeriod] (
[AssessmentFamilyTitle] nvarchar(60) NOT NULL ,
[AssessmentPeriodDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentFamilyTitle], [AssessmentPeriodDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentFamilyAssessmentPeriod
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentFamilyContentStandard
-- ----------------------------

CREATE TABLE [edfi].[AssessmentFamilyContentStandard] (
[AssessmentFamilyTitle] nvarchar(60) NOT NULL ,
[Title] nvarchar(75) NOT NULL ,
[Version] nvarchar(50) NULL ,
[URI] nvarchar(255) NULL ,
[PublicationDate] date NULL ,
[PublicationYear] smallint NULL ,
[PublicationStatusTypeId] int NULL ,
[MandatingEducationOrganizationId] int NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentFamilyTitle])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentFamilyContentStandard
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentFamilyContentStandardAuthor
-- ----------------------------

CREATE TABLE [edfi].[AssessmentFamilyContentStandardAuthor] (
[AssessmentFamilyTitle] nvarchar(60) NOT NULL ,
[Author] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentFamilyTitle], [Author])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentFamilyContentStandardAuthor
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentFamilyIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[AssessmentFamilyIdentificationCode] (
[AssessmentFamilyTitle] nvarchar(60) NOT NULL ,
[AssessmentIdentificationSystemTypeId] int NOT NULL ,
[AssigningOrganizationIdentificationCode] nvarchar(60) NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentFamilyTitle], [AssessmentIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentFamilyIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentFamilyLanguage
-- ----------------------------

CREATE TABLE [edfi].[AssessmentFamilyLanguage] (
[AssessmentFamilyTitle] nvarchar(60) NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentFamilyTitle], [LanguageDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentFamilyLanguage
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[AssessmentIdentificationCode] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AssessmentIdentificationSystemTypeId] int NOT NULL ,
[AssigningOrganizationIdentificationCode] nvarchar(60) NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AssessmentIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentIdentificationSystemType
-- ----------------------------

CREATE TABLE [edfi].[AssessmentIdentificationSystemType] (
[AssessmentIdentificationSystemTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentIdentificationSystemType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AssessmentIdentificationSystemType_ShortDescription] ON [edfi].[AssessmentIdentificationSystemType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AssessmentIdentificationSystemType] ON [edfi].[AssessmentIdentificationSystemType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentItem
-- ----------------------------

CREATE TABLE [edfi].[AssessmentItem] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[AssessmentItemCategoryTypeId] int NULL ,
[MaxRawScore] int NULL ,
[CorrectResponse] nvarchar(20) NULL ,
[ExpectedTimeAssessed] nvarchar(30) NULL ,
[Nomenclature] nvarchar(35) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentItem
-- ----------------------------
CREATE UNIQUE INDEX [GUID_AssessmentItem] ON [edfi].[AssessmentItem]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_AssessmentItem_Item] ON [edfi].[AssessmentItem]
([Version] ASC, [AcademicSubjectDescriptorId] ASC, [AssessedGradeLevelDescriptorId] ASC, [IdentificationCode] ASC, [AssessmentTitle] ASC) 
GO

-- ----------------------------
-- Table structure for AssessmentItemCategoryType
-- ----------------------------

CREATE TABLE [edfi].[AssessmentItemCategoryType] (
[AssessmentItemCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentItemCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentItemCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AssessmentItemCategoryType_ShortDescription] ON [edfi].[AssessmentItemCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AssessmentItemCategoryType] ON [edfi].[AssessmentItemCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentItemLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[AssessmentItemLearningStandard] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[LearningStandardId] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentItemLearningStandard
-- ----------------------------
CREATE INDEX [IX_AssessmentItemLearningStandard_LearningStandardId] ON [edfi].[AssessmentItemLearningStandard]
([LearningStandardId] ASC) 
GO

-- ----------------------------
-- Table structure for AssessmentItemResultType
-- ----------------------------

CREATE TABLE [edfi].[AssessmentItemResultType] (
[AssessmentItemResultTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentItemResultTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentItemResultType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AssessmentItemResultType_ShortDescription] ON [edfi].[AssessmentItemResultType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AssessmentItemResultType] ON [edfi].[AssessmentItemResultType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentLanguage
-- ----------------------------

CREATE TABLE [edfi].[AssessmentLanguage] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [LanguageDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentLanguage
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentPerformanceLevel
-- ----------------------------

CREATE TABLE [edfi].[AssessmentPerformanceLevel] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[PerformanceLevelDescriptorId] int NOT NULL ,
[AssessmentReportingMethodTypeId] int NOT NULL ,
[MinimumScore] nvarchar(35) NULL ,
[MaximumScore] nvarchar(35) NULL ,
[ResultDatatypeTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [PerformanceLevelDescriptorId], [AssessmentReportingMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentPerformanceLevel
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentPeriodDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AssessmentPeriodDescriptor] (
[AssessmentPeriodDescriptorId] int NOT NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
PRIMARY KEY ([AssessmentPeriodDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentPeriodDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentProgram
-- ----------------------------

CREATE TABLE [edfi].[AssessmentProgram] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [EducationOrganizationId], [ProgramTypeId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentProgram
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentReportingMethodType
-- ----------------------------

CREATE TABLE [edfi].[AssessmentReportingMethodType] (
[AssessmentReportingMethodTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentReportingMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentReportingMethodType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AssessmentReportingMethodType_ShortDescription] ON [edfi].[AssessmentReportingMethodType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AssessmentReportingMethodType] ON [edfi].[AssessmentReportingMethodType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for AssessmentScore
-- ----------------------------

CREATE TABLE [edfi].[AssessmentScore] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AssessmentReportingMethodTypeId] int NOT NULL ,
[MinimumScore] nvarchar(35) NULL ,
[MaximumScore] nvarchar(35) NULL ,
[ResultDatatypeTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AssessmentReportingMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentScore
-- ----------------------------

-- ----------------------------
-- Table structure for AssessmentSection
-- ----------------------------

CREATE TABLE [edfi].[AssessmentSection] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table AssessmentSection
-- ----------------------------

-- ----------------------------
-- Table structure for AttendanceEventCategoryDescriptor
-- ----------------------------

CREATE TABLE [edfi].[AttendanceEventCategoryDescriptor] (
[AttendanceEventCategoryDescriptorId] int NOT NULL ,
[AttendanceEventCategoryTypeId] int NOT NULL ,
PRIMARY KEY ([AttendanceEventCategoryDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table AttendanceEventCategoryDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for AttendanceEventCategoryType
-- ----------------------------

CREATE TABLE [edfi].[AttendanceEventCategoryType] (
[AttendanceEventCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AttendanceEventCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table AttendanceEventCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_AttendanceEventCategoryType_ShortDescription] ON [edfi].[AttendanceEventCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_AttendanceEventCategoryType] ON [edfi].[AttendanceEventCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for BehaviorDescriptor
-- ----------------------------

CREATE TABLE [edfi].[BehaviorDescriptor] (
[BehaviorDescriptorId] int NOT NULL ,
[BehaviorTypeId] int NULL ,
PRIMARY KEY ([BehaviorDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table BehaviorDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for BehaviorType
-- ----------------------------

CREATE TABLE [edfi].[BehaviorType] (
[BehaviorTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([BehaviorTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table BehaviorType
-- ----------------------------
CREATE UNIQUE INDEX [AK_BehaviorType_ShortDescription] ON [edfi].[BehaviorType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_BehaviorType] ON [edfi].[BehaviorType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for BellSchedule
-- ----------------------------

CREATE TABLE [edfi].[BellSchedule] (
[SchoolId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[Date] date NOT NULL ,
[BellScheduleName] nvarchar(60) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [GradeLevelDescriptorId], [Date], [BellScheduleName])
)


GO

-- ----------------------------
-- Indexes structure for table BellSchedule
-- ----------------------------
CREATE UNIQUE INDEX [GUID_BellSchedule] ON [edfi].[BellSchedule]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for BellScheduleMeetingTime
-- ----------------------------

CREATE TABLE [edfi].[BellScheduleMeetingTime] (
[SchoolId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[Date] date NOT NULL ,
[BellScheduleName] nvarchar(60) NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[StartTime] time(7) NOT NULL ,
[EndTime] time(7) NOT NULL ,
[AlternateDayName] nvarchar(20) NULL ,
[OfficialAttendancePeriod] bit NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [GradeLevelDescriptorId], [Date], [BellScheduleName], [ClassPeriodName], [StartTime])
)


GO

-- ----------------------------
-- Indexes structure for table BellScheduleMeetingTime
-- ----------------------------

-- ----------------------------
-- Table structure for Budget
-- ----------------------------

CREATE TABLE [edfi].[Budget] (
[EducationOrganizationId] int NOT NULL ,
[AccountNumber] nvarchar(50) NOT NULL ,
[FiscalYear] int NOT NULL ,
[AsOfDate] date NOT NULL ,
[Amount] money NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear], [AsOfDate])
)


GO

-- ----------------------------
-- Indexes structure for table Budget
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Budget] ON [edfi].[Budget]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CalendarDate
-- ----------------------------

CREATE TABLE [edfi].[CalendarDate] (
[EducationOrganizationId] int NOT NULL ,
[Date] date NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [Date])
)


GO

-- ----------------------------
-- Indexes structure for table CalendarDate
-- ----------------------------
CREATE UNIQUE INDEX [GUID_CalendarDate] ON [edfi].[CalendarDate]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CalendarDateCalendarEvent
-- ----------------------------

CREATE TABLE [edfi].[CalendarDateCalendarEvent] (
[EducationOrganizationId] int NOT NULL ,
[Date] date NOT NULL ,
[CalendarEventDescriptorId] int NOT NULL ,
[EventDuration] decimal(3,2) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [Date], [CalendarEventDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CalendarDateCalendarEvent
-- ----------------------------

-- ----------------------------
-- Table structure for CalendarEventDescriptor
-- ----------------------------

CREATE TABLE [edfi].[CalendarEventDescriptor] (
[CalendarEventDescriptorId] int NOT NULL ,
[CalendarEventTypeId] int NOT NULL ,
PRIMARY KEY ([CalendarEventDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CalendarEventDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for CalendarEventType
-- ----------------------------

CREATE TABLE [edfi].[CalendarEventType] (
[CalendarEventTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CalendarEventTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CalendarEventType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CalendarEventType_ShortDescription] ON [edfi].[CalendarEventType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CalendarEventType] ON [edfi].[CalendarEventType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CareerPathwayType
-- ----------------------------

CREATE TABLE [edfi].[CareerPathwayType] (
[CareerPathwayTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CareerPathwayTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CareerPathwayType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CareerPathwayType_ShortDescription] ON [edfi].[CareerPathwayType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CareerPathwayType] ON [edfi].[CareerPathwayType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CharterStatusType
-- ----------------------------

CREATE TABLE [edfi].[CharterStatusType] (
[CharterStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CharterStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CharterStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CharterStatusType_ShortDescription] ON [edfi].[CharterStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CharterStatusType] ON [edfi].[CharterStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CitizenshipStatusType
-- ----------------------------

CREATE TABLE [edfi].[CitizenshipStatusType] (
[CitizenshipStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CitizenshipStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CitizenshipStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CitizenshipStatusType_ShortDescription] ON [edfi].[CitizenshipStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CitizenshipStatusType] ON [edfi].[CitizenshipStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ClassPeriod
-- ----------------------------

CREATE TABLE [edfi].[ClassPeriod] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName])
)


GO

-- ----------------------------
-- Indexes structure for table ClassPeriod
-- ----------------------------
CREATE UNIQUE INDEX [GUID_ClassPeriod] ON [edfi].[ClassPeriod]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ClassroomPositionDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ClassroomPositionDescriptor] (
[ClassroomPositionDescriptorId] int NOT NULL ,
[ClassroomPositionTypeId] int NULL ,
PRIMARY KEY ([ClassroomPositionDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ClassroomPositionDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ClassroomPositionType
-- ----------------------------

CREATE TABLE [edfi].[ClassroomPositionType] (
[ClassroomPositionTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ClassroomPositionTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ClassroomPositionType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ClassroomPositionType_ShortDescription] ON [edfi].[ClassroomPositionType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ClassroomPositionType] ON [edfi].[ClassroomPositionType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Cohort
-- ----------------------------

CREATE TABLE [edfi].[Cohort] (
[EducationOrganizationId] int NOT NULL ,
[CohortIdentifier] nvarchar(20) NOT NULL ,
[CohortDescription] nvarchar(1024) NULL ,
[CohortTypeId] int NOT NULL ,
[CohortScopeTypeId] int NULL ,
[AcademicSubjectDescriptorId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CohortIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table Cohort
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Cohort] ON [edfi].[Cohort]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CohortProgram
-- ----------------------------

CREATE TABLE [edfi].[CohortProgram] (
[EducationOrganizationId] int NOT NULL ,
[CohortIdentifier] nvarchar(20) NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CohortIdentifier], [ProgramEducationOrganizationId], [ProgramTypeId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table CohortProgram
-- ----------------------------

-- ----------------------------
-- Table structure for CohortScopeType
-- ----------------------------

CREATE TABLE [edfi].[CohortScopeType] (
[CohortScopeTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CohortScopeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CohortScopeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CohortScopeType_ShortDescription] ON [edfi].[CohortScopeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CohortScopeType] ON [edfi].[CohortScopeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CohortType
-- ----------------------------

CREATE TABLE [edfi].[CohortType] (
[CohortTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CohortTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CohortType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CohortType_ShortDescription] ON [edfi].[CohortType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CohortType] ON [edfi].[CohortType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CohortYearType
-- ----------------------------

CREATE TABLE [edfi].[CohortYearType] (
[CohortYearTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CohortYearTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CohortYearType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CohortYearType_ShortDescription] ON [edfi].[CohortYearType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CohortYearType] ON [edfi].[CohortYearType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CompetencyLevelDescriptor
-- ----------------------------

CREATE TABLE [edfi].[CompetencyLevelDescriptor] (
[CompetencyLevelDescriptorId] int NOT NULL ,
[PerformanceBaseConversionTypeId] int NULL ,
PRIMARY KEY ([CompetencyLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CompetencyLevelDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for CompetencyObjective
-- ----------------------------

CREATE TABLE [edfi].[CompetencyObjective] (
[Objective] nvarchar(60) NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CompetencyObjectiveId] nvarchar(60) NULL ,
[Description] nvarchar(1024) NULL ,
[SuccessCriteria] nvarchar(150) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([Objective], [ObjectiveGradeLevelDescriptorId], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table CompetencyObjective
-- ----------------------------
CREATE UNIQUE INDEX [GUID_CompetencyObjective] ON [edfi].[CompetencyObjective]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ContentClassType
-- ----------------------------

CREATE TABLE [edfi].[ContentClassType] (
[ContentClassTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentClassTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ContentClassType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ContentClassType_ShortDescription] ON [edfi].[ContentClassType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ContentClassType] ON [edfi].[ContentClassType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ContinuationOfServicesReasonDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ContinuationOfServicesReasonDescriptor] (
[ContinuationOfServicesReasonDescriptorId] int NOT NULL ,
[ContinuationOfServicesReasonTypeId] int NOT NULL ,
PRIMARY KEY ([ContinuationOfServicesReasonDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ContinuationOfServicesReasonDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ContinuationOfServicesReasonType
-- ----------------------------

CREATE TABLE [edfi].[ContinuationOfServicesReasonType] (
[ContinuationOfServicesReasonTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContinuationOfServicesReasonTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ContinuationOfServicesReasonType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ContinuationOfServicesReasonType_ShortDescription] ON [edfi].[ContinuationOfServicesReasonType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ContinuationOfServicesReasonType] ON [edfi].[ContinuationOfServicesReasonType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ContractedStaff
-- ----------------------------

CREATE TABLE [edfi].[ContractedStaff] (
[StaffUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[AccountNumber] nvarchar(50) NOT NULL ,
[FiscalYear] int NOT NULL ,
[AsOfDate] date NOT NULL ,
[AmountToDate] money NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [EducationOrganizationId], [AccountNumber], [FiscalYear], [AsOfDate])
)


GO

-- ----------------------------
-- Indexes structure for table ContractedStaff
-- ----------------------------
CREATE UNIQUE INDEX [GUID_ContractedStaff] ON [edfi].[ContractedStaff]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CostRateType
-- ----------------------------

CREATE TABLE [edfi].[CostRateType] (
[CostRateTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[CodeValue] nvarchar(50) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CostRateTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CostRateType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CostRateType_ShortDescription] ON [edfi].[CostRateType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CostRateType] ON [edfi].[CostRateType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CountryCodeType
-- ----------------------------

CREATE TABLE [edfi].[CountryCodeType] (
[CountryCodeTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CountryCodeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CountryCodeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CountryCodeType_ShortDescription] ON [edfi].[CountryCodeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CountryCodeType] ON [edfi].[CountryCodeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CountryType
-- ----------------------------

CREATE TABLE [edfi].[CountryType] (
[CountryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CountryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CountryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CountryType_ShortDescription] ON [edfi].[CountryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CountryType] ON [edfi].[CountryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Course
-- ----------------------------

CREATE TABLE [edfi].[Course] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CourseTitle] nvarchar(60) NOT NULL ,
[NumberOfParts] int NOT NULL ,
[AcademicSubjectDescriptorId] int NULL ,
[CourseDescription] nvarchar(1024) NULL ,
[DateCourseAdopted] date NULL ,
[HighSchoolCourseRequirement] bit NULL ,
[CourseGPAApplicabilityTypeId] int NULL ,
[CourseDefinedByTypeId] int NULL ,
[MinimumAvailableCreditTypeId] int NULL ,
[MinimumAvailableCreditConversion] decimal(9,2) NULL ,
[MinimumAvailableCredit] decimal(9,2) NULL ,
[MaximumAvailableCreditTypeId] int NULL ,
[MaximumAvailableCreditConversion] decimal(9,2) NULL ,
[MaximumAvailableCredit] decimal(9,2) NULL ,
[CareerPathwayTypeId] int NULL ,
[TimeRequiredForCompletion] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode])
)


GO

-- ----------------------------
-- Indexes structure for table Course
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Course] ON [edfi].[Course]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_Course_IdentyCrseCdEdOrgIdSubjAreaTypeId] ON [edfi].[Course]
([CourseCode] ASC, [EducationOrganizationId] ASC, [AcademicSubjectDescriptorId] ASC) 
GO

-- ----------------------------
-- Table structure for CourseAttemptResultType
-- ----------------------------

CREATE TABLE [edfi].[CourseAttemptResultType] (
[CourseAttemptResultTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CourseAttemptResultTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseAttemptResultType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CourseAttemptResultType_ShortDescription] ON [edfi].[CourseAttemptResultType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CourseAttemptResultType] ON [edfi].[CourseAttemptResultType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseCodeSystemType
-- ----------------------------

CREATE TABLE [edfi].[CourseCodeSystemType] (
[CourseCodeSystemTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CourseCodeSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseCodeSystemType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CourseCodeSystemType_ShortDescription] ON [edfi].[CourseCodeSystemType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CourseCodeSystemType] ON [edfi].[CourseCodeSystemType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseCompetencyLevel
-- ----------------------------

CREATE TABLE [edfi].[CourseCompetencyLevel] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CompetencyLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode], [CompetencyLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseCompetencyLevel
-- ----------------------------

-- ----------------------------
-- Table structure for CourseDefinedByType
-- ----------------------------

CREATE TABLE [edfi].[CourseDefinedByType] (
[CourseDefinedByTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CourseDefinedByTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseDefinedByType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CourseDefinedByType_ShortDescription] ON [edfi].[CourseDefinedByType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CourseDefinedByType] ON [edfi].[CourseDefinedByType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseGPAApplicabilityType
-- ----------------------------

CREATE TABLE [edfi].[CourseGPAApplicabilityType] (
[CourseGPAApplicabilityTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CourseGPAApplicabilityTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseGPAApplicabilityType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CourseGPAApplicabilityType_ShortDescription] ON [edfi].[CourseGPAApplicabilityType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CourseGPAApplicabilityType] ON [edfi].[CourseGPAApplicabilityType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[CourseGradeLevel] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for CourseIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[CourseIdentificationCode] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CourseCodeSystemTypeId] int NOT NULL ,
[AssigningOrganizationIdentificationCode] nvarchar(60) NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode], [CourseCodeSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for CourseLearningObjective
-- ----------------------------

CREATE TABLE [edfi].[CourseLearningObjective] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseLearningObjective
-- ----------------------------

-- ----------------------------
-- Table structure for CourseLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[CourseLearningStandard] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[LearningStandardId] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode], [LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseLearningStandard
-- ----------------------------

-- ----------------------------
-- Table structure for CourseLevelCharacteristic
-- ----------------------------

CREATE TABLE [edfi].[CourseLevelCharacteristic] (
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CourseLevelCharacteristicTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [CourseCode], [CourseLevelCharacteristicTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseLevelCharacteristic
-- ----------------------------

-- ----------------------------
-- Table structure for CourseLevelCharacteristicType
-- ----------------------------

CREATE TABLE [edfi].[CourseLevelCharacteristicType] (
[CourseLevelCharacteristicTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CourseLevelCharacteristicTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseLevelCharacteristicType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CourseLevelCharacteristicType_ShortDescription] ON [edfi].[CourseLevelCharacteristicType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CourseLevelCharacteristicType] ON [edfi].[CourseLevelCharacteristicType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseOffering
-- ----------------------------

CREATE TABLE [edfi].[CourseOffering] (
[SchoolId] int NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[LocalCourseTitle] nvarchar(60) NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[InstructionalTimePlanned] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [TermTypeId], [SchoolYear], [LocalCourseCode])
)


GO

-- ----------------------------
-- Indexes structure for table CourseOffering
-- ----------------------------
CREATE UNIQUE INDEX [GUID_CourseOffering] ON [edfi].[CourseOffering]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseOfferingCurriculumUsed
-- ----------------------------

CREATE TABLE [edfi].[CourseOfferingCurriculumUsed] (
[SchoolId] int NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[CurriculumUsedTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [TermTypeId], [SchoolYear], [LocalCourseCode], [CurriculumUsedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseOfferingCurriculumUsed
-- ----------------------------

-- ----------------------------
-- Table structure for CourseRepeatCodeType
-- ----------------------------

CREATE TABLE [edfi].[CourseRepeatCodeType] (
[CourseRepeatCodeTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CourseRepeatCodeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseRepeatCodeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CourseRepeatCodeType_ShortDescription] ON [edfi].[CourseRepeatCodeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CourseRepeatCodeType] ON [edfi].[CourseRepeatCodeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseTranscript
-- ----------------------------

CREATE TABLE [edfi].[CourseTranscript] (
[StudentUSI] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[CourseEducationOrganizationId] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CourseAttemptResultTypeId] int NOT NULL ,
[AttemptedCreditTypeId] int NULL ,
[AttemptedCreditConversion] decimal(9,2) NULL ,
[AttemptedCredit] decimal(9,2) NULL ,
[EarnedCreditTypeId] int NULL ,
[EarnedCreditConversion] decimal(9,2) NULL ,
[EarnedCredit] decimal(9,2) NOT NULL ,
[GradeLevelDescriptorId] int NULL ,
[MethodCreditEarnedTypeId] int NULL ,
[FinalLetterGradeEarned] nvarchar(20) NULL ,
[FinalNumericGradeEarned] int NULL ,
[CourseRepeatCodeTypeId] int NULL ,
[SchoolId] int NULL ,
[CourseTitle] nvarchar(60) NULL ,
[LocalCourseCode] nvarchar(60) NULL ,
[LocalCourseTitle] nvarchar(60) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [EducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseTranscript
-- ----------------------------
CREATE UNIQUE INDEX [GUID_CourseTranscript] ON [edfi].[CourseTranscript]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CourseTranscriptAdditionalCredit
-- ----------------------------

CREATE TABLE [edfi].[CourseTranscriptAdditionalCredit] (
[StudentUSI] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[CourseEducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CourseAttemptResultTypeId] int NOT NULL ,
[AdditionalCreditTypeId] int NOT NULL ,
[Credit] decimal(9,2) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId], [AdditionalCreditTypeId], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table CourseTranscriptAdditionalCredit
-- ----------------------------

-- ----------------------------
-- Table structure for CourseTranscriptExternalCourse
-- ----------------------------

CREATE TABLE [edfi].[CourseTranscriptExternalCourse] (
[StudentUSI] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[CourseEducationOrganizationId] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CourseAttemptResultTypeId] int NOT NULL ,
[NameOfInstitution] nvarchar(75) NOT NULL ,
[ExternalCourseCode] nvarchar(60) NOT NULL ,
[ExternalCourseTitle] nvarchar(60) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [EducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId], [NameOfInstitution], [ExternalCourseCode])
)


GO

-- ----------------------------
-- Indexes structure for table CourseTranscriptExternalCourse
-- ----------------------------

-- ----------------------------
-- Table structure for CredentialFieldDescriptor
-- ----------------------------

CREATE TABLE [edfi].[CredentialFieldDescriptor] (
[CredentialFieldDescriptorId] int NOT NULL ,
[AcademicSubjectDescriptorId] int NULL ,
PRIMARY KEY ([CredentialFieldDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table CredentialFieldDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for CredentialType
-- ----------------------------

CREATE TABLE [edfi].[CredentialType] (
[CredentialTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CredentialTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CredentialType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CredentialType_ShortDescription] ON [edfi].[CredentialType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CredentialType] ON [edfi].[CredentialType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CreditType
-- ----------------------------

CREATE TABLE [edfi].[CreditType] (
[CreditTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CreditTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CreditType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CreditType_ShortDescription] ON [edfi].[CreditType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CreditType] ON [edfi].[CreditType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for CurriculumUsedType
-- ----------------------------

CREATE TABLE [edfi].[CurriculumUsedType] (
[CurriculumUsedTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([CurriculumUsedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table CurriculumUsedType
-- ----------------------------
CREATE UNIQUE INDEX [AK_CurriculumUsedType_ShortDescription] ON [edfi].[CurriculumUsedType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_CurriculumUsedType] ON [edfi].[CurriculumUsedType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DeliveryMethodType
-- ----------------------------

CREATE TABLE [edfi].[DeliveryMethodType] (
[DeliveryMethodTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[CodeValue] nvarchar(50) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DeliveryMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DeliveryMethodType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DeliveryMethodType_ShortDescription] ON [edfi].[DeliveryMethodType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DeliveryMethodType] ON [edfi].[DeliveryMethodType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Descriptor
-- ----------------------------

CREATE TABLE [edfi].[Descriptor] (
[DescriptorId] int NOT NULL IDENTITY(1,1) ,
[Namespace] nvarchar(255) NOT NULL ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(75) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[PriorDescriptorId] int NULL ,
[EffectiveBeginDate] date NULL ,
[EffectiveEndDate] date NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DescriptorId]),
UNIQUE ([Namespace] ASC, [CodeValue] ASC)
)


GO

-- ----------------------------
-- Indexes structure for table Descriptor
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Descriptor] ON [edfi].[Descriptor]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DiagnosisDescriptor
-- ----------------------------

CREATE TABLE [edfi].[DiagnosisDescriptor] (
[DiagnosisDescriptorId] int NOT NULL ,
[DiagnosisTypeId] int NULL ,
PRIMARY KEY ([DiagnosisDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table DiagnosisDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for DiagnosisType
-- ----------------------------

CREATE TABLE [edfi].[DiagnosisType] (
[DiagnosisTypeId] int NOT NULL IDENTITY(1,1) ,
[Description] nvarchar(1024) NULL ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DiagnosisTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DiagnosisType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DiagnosisType_ShortDescription] ON [edfi].[DiagnosisType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DiagnosisType] ON [edfi].[DiagnosisType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DiplomaLevelType
-- ----------------------------

CREATE TABLE [edfi].[DiplomaLevelType] (
[DiplomaLevelTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DiplomaLevelTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DiplomaLevelType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DiplomaLevelType_ShortDescription] ON [edfi].[DiplomaLevelType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DiplomaLevelType] ON [edfi].[DiplomaLevelType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DiplomaType
-- ----------------------------

CREATE TABLE [edfi].[DiplomaType] (
[DiplomaTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DiplomaTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DiplomaType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DiplomaType_ShortDescription] ON [edfi].[DiplomaType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DiplomaType] ON [edfi].[DiplomaType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DisabilityCategoryType
-- ----------------------------

CREATE TABLE [edfi].[DisabilityCategoryType] (
[DisabilityCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[CodeValue] nvarchar(50) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DisabilityCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DisabilityCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DisabilityCategoryType_ShortDescription] ON [edfi].[DisabilityCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DisabilityCategoryType] ON [edfi].[DisabilityCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DisabilityDescriptor
-- ----------------------------

CREATE TABLE [edfi].[DisabilityDescriptor] (
[DisabilityDescriptorId] int NOT NULL ,
[DisabilityCategoryTypeId] int NOT NULL ,
[DisabilityTypeId] int NULL ,
PRIMARY KEY ([DisabilityDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table DisabilityDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for DisabilityType
-- ----------------------------

CREATE TABLE [edfi].[DisabilityType] (
[DisabilityTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DisabilityTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DisabilityType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DisabilityType_ShortDescription] ON [edfi].[DisabilityType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DisabilityType] ON [edfi].[DisabilityType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DisciplineAction
-- ----------------------------

CREATE TABLE [edfi].[DisciplineAction] (
[StudentUSI] int NOT NULL ,
[DisciplineActionIdentifier] nvarchar(20) NOT NULL ,
[DisciplineDate] date NOT NULL ,
[DisciplineActionLength] int NULL ,
[ActualDisciplineActionLength] int NULL ,
[DisciplineActionLengthDifferenceReasonTypeId] int NULL ,
[ResponsibilitySchoolId] int NOT NULL ,
[AssignmentSchoolId] int NULL ,
[RelatedToZeroTolerancePolicy] bit NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineAction
-- ----------------------------
CREATE UNIQUE INDEX [GUID_DisciplineAction] ON [edfi].[DisciplineAction]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DisciplineActionDiscipline
-- ----------------------------

CREATE TABLE [edfi].[DisciplineActionDiscipline] (
[StudentUSI] int NOT NULL ,
[DisciplineActionIdentifier] nvarchar(20) NOT NULL ,
[DisciplineDate] date NOT NULL ,
[DisciplineDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate], [DisciplineDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineActionDiscipline
-- ----------------------------

-- ----------------------------
-- Table structure for DisciplineActionDisciplineIncident
-- ----------------------------

CREATE TABLE [edfi].[DisciplineActionDisciplineIncident] (
[StudentUSI] int NOT NULL ,
[DisciplineActionIdentifier] nvarchar(20) NOT NULL ,
[DisciplineDate] date NOT NULL ,
[SchoolId] int NOT NULL ,
[IncidentIdentifier] nvarchar(20) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate], [SchoolId], [IncidentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineActionDisciplineIncident
-- ----------------------------

-- ----------------------------
-- Table structure for DisciplineActionLengthDifferenceReasonType
-- ----------------------------

CREATE TABLE [edfi].[DisciplineActionLengthDifferenceReasonType] (
[DisciplineActionLengthDifferenceReasonTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DisciplineActionLengthDifferenceReasonTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineActionLengthDifferenceReasonType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DisciplineActionLengthDifferenceReasonType_ShortDescription] ON [edfi].[DisciplineActionLengthDifferenceReasonType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DisciplineActionLengthDifferenceReasonType] ON [edfi].[DisciplineActionLengthDifferenceReasonType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DisciplineActionStaff
-- ----------------------------

CREATE TABLE [edfi].[DisciplineActionStaff] (
[StudentUSI] int NOT NULL ,
[DisciplineActionIdentifier] nvarchar(20) NOT NULL ,
[DisciplineDate] date NOT NULL ,
[StaffUSI] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate], [StaffUSI])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineActionStaff
-- ----------------------------

-- ----------------------------
-- Table structure for DisciplineDescriptor
-- ----------------------------

CREATE TABLE [edfi].[DisciplineDescriptor] (
[DisciplineDescriptorId] int NOT NULL ,
[DisciplineTypeId] int NULL ,
PRIMARY KEY ([DisciplineDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for DisciplineIncident
-- ----------------------------

CREATE TABLE [edfi].[DisciplineIncident] (
[SchoolId] int NOT NULL ,
[IncidentIdentifier] nvarchar(20) NOT NULL ,
[IncidentDate] date NOT NULL ,
[IncidentTime] time(7) NULL ,
[IncidentLocationTypeId] int NULL ,
[ReporterDescriptionDescriptorId] int NULL ,
[ReporterName] nvarchar(75) NULL ,
[ReportedToLawEnforcement] bit NULL ,
[CaseNumber] nvarchar(20) NULL ,
[StaffUSI] int NULL ,
[IncidentDescription] nvarchar(1024) NULL ,
[IncidentCost] money NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [IncidentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineIncident
-- ----------------------------
CREATE UNIQUE INDEX [GUID_DisciplineIncident] ON [edfi].[DisciplineIncident]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for DisciplineIncidentBehavior
-- ----------------------------

CREATE TABLE [edfi].[DisciplineIncidentBehavior] (
[SchoolId] int NOT NULL ,
[IncidentIdentifier] nvarchar(20) NOT NULL ,
[BehaviorDescriptorId] int NOT NULL ,
[BehaviorDetailedDescription] nvarchar(1024) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [IncidentIdentifier], [BehaviorDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineIncidentBehavior
-- ----------------------------

-- ----------------------------
-- Table structure for DisciplineIncidentWeapon
-- ----------------------------

CREATE TABLE [edfi].[DisciplineIncidentWeapon] (
[SchoolId] int NOT NULL ,
[IncidentIdentifier] nvarchar(20) NOT NULL ,
[WeaponDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [IncidentIdentifier], [WeaponDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineIncidentWeapon
-- ----------------------------

-- ----------------------------
-- Table structure for DisciplineType
-- ----------------------------

CREATE TABLE [edfi].[DisciplineType] (
[DisciplineTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[CodeValue] nvarchar(50) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([DisciplineTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table DisciplineType
-- ----------------------------
CREATE UNIQUE INDEX [AK_DisciplineType_ShortDescription] ON [edfi].[DisciplineType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_DisciplineType] ON [edfi].[DisciplineType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EdFiException
-- ----------------------------

CREATE TABLE [edfi].[EdFiException] (
[EdFiExceptionId] int NOT NULL IDENTITY(1,1) ,
[TableName] nvarchar(255) NULL ,
[ColumnNameList] nvarchar(4000) NULL ,
[ColumnValueList] nvarchar(4000) NULL ,
[ErrorMessage] nvarchar(4000) NULL ,
[IdentifierCondition] nvarchar(4000) NULL ,
[LookupCondition] nvarchar(4000) NULL ,
[ExceptionLevel] nvarchar(20) NULL ,
[StartTime] datetime NULL ,
[PackageName] nvarchar(255) NULL ,
[TaskName] nvarchar(255) NULL ,
[ComponentName] nvarchar(255) NULL ,
[ErrorCode] int NULL ,
[ErrorDescription] nvarchar(1000) NULL ,
[ErrorColumn] int NULL ,
[ErrorColumnName] nvarchar(255) NULL ,
PRIMARY KEY ([EdFiExceptionId])
)


GO

-- ----------------------------
-- Indexes structure for table EdFiException
-- ----------------------------

-- ----------------------------
-- Table structure for EducationalEnvironmentType
-- ----------------------------

CREATE TABLE [edfi].[EducationalEnvironmentType] (
[EducationalEnvironmentTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationalEnvironmentTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationalEnvironmentType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EducationalEnvironmentType_ShortDescription] ON [edfi].[EducationalEnvironmentType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EducationalEnvironmentType] ON [edfi].[EducationalEnvironmentType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationContent
-- ----------------------------

CREATE TABLE [edfi].[EducationContent] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[LearningResourceMetadataURI] nvarchar(255) NULL ,
[ShortDescription] nvarchar(75) NULL ,
[Description] nvarchar(1024) NULL ,
[AdditionalAuthorsIndicator] bit NULL ,
[Publisher] nvarchar(50) NULL ,
[TimeRequired] nvarchar(30) NULL ,
[InteractivityStyleTypeId] int NULL ,
[ContentClassTypeId] int NULL ,
[UseRightsURL] nvarchar(255) NULL ,
[PublicationDate] date NULL ,
[PublicationYear] smallint NULL ,
[LearningStandardId] nvarchar(60) NULL ,
[Version] nvarchar(10) NULL ,
[Cost] money NULL ,
[CostRateTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_EducationContent] ON [edfi].[EducationContent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationContentAppropriateGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[EducationContentAppropriateGradeLevel] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentAppropriateGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for EducationContentAppropriateSex
-- ----------------------------

CREATE TABLE [edfi].[EducationContentAppropriateSex] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[SexTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [SexTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentAppropriateSex
-- ----------------------------

-- ----------------------------
-- Table structure for EducationContentAuthor
-- ----------------------------

CREATE TABLE [edfi].[EducationContentAuthor] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[Author] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [Author])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentAuthor
-- ----------------------------

-- ----------------------------
-- Table structure for EducationContentDerivativeSourceEducationContent
-- ----------------------------

CREATE TABLE [edfi].[EducationContentDerivativeSourceEducationContent] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[DerivativeSourceContentIdentifier] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [DerivativeSourceContentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentDerivativeSourceEducationContent
-- ----------------------------

-- ----------------------------
-- Table structure for EducationContentDerivativeSourceLearningResourceMetadataURI
-- ----------------------------

CREATE TABLE [edfi].[EducationContentDerivativeSourceLearningResourceMetadataURI] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[LearningResourceMetadataURI] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [LearningResourceMetadataURI])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentDerivativeSourceLearningResourceMetadataURI
-- ----------------------------

-- ----------------------------
-- Table structure for EducationContentDerivativeSourceURI
-- ----------------------------

CREATE TABLE [edfi].[EducationContentDerivativeSourceURI] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[URI] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [URI])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentDerivativeSourceURI
-- ----------------------------

-- ----------------------------
-- Table structure for EducationContentLanguage
-- ----------------------------

CREATE TABLE [edfi].[EducationContentLanguage] (
[ContentIdentifier] nvarchar(225) NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ContentIdentifier], [LanguageDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationContentLanguage
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganization
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganization] (
[EducationOrganizationId] int NOT NULL ,
[StateOrganizationId] nvarchar(60) NOT NULL ,
[NameOfInstitution] nvarchar(75) NOT NULL ,
[ShortNameOfInstitution] nvarchar(75) NULL ,
[WebSite] nvarchar(255) NULL ,
[OperationalStatusTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganization
-- ----------------------------
CREATE UNIQUE INDEX [GUID_EducationOrganization] ON [edfi].[EducationOrganization]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationOrganizationAddress
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationAddress] (
[EducationOrganizationId] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[StreetNumberName] nvarchar(150) NOT NULL ,
[ApartmentRoomSuiteNumber] nvarchar(50) NULL ,
[BuildingSiteNumber] nvarchar(20) NULL ,
[City] nvarchar(30) NOT NULL ,
[StateAbbreviationTypeId] int NOT NULL ,
[PostalCode] nvarchar(17) NOT NULL ,
[NameOfCounty] nvarchar(30) NULL ,
[CountyFIPSCode] nvarchar(5) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationAddress
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganizationCategory
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationCategory] (
[EducationOrganizationId] int NOT NULL ,
[EducationOrganizationCategoryTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [EducationOrganizationCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationCategory
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganizationCategoryType
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationCategoryType] (
[EducationOrganizationCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[CodeValue] nvarchar(75) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EducationOrganizationCategoryType_ShortDescription] ON [edfi].[EducationOrganizationCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EducationOrganizationCategoryType] ON [edfi].[EducationOrganizationCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationOrganizationIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationIdentificationCode] (
[EducationOrganizationId] int NOT NULL ,
[EducationOrganizationIdentificationSystemTypeId] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [EducationOrganizationIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganizationIdentificationSystemType
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationIdentificationSystemType] (
[EducationOrganizationIdentificationSystemTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationIdentificationSystemType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EducationOrganizationIdentificationSystemType_ShortDescription] ON [edfi].[EducationOrganizationIdentificationSystemType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EducationOrganizationIdentificationSystemType] ON [edfi].[EducationOrganizationIdentificationSystemType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationOrganizationInstitutionTelephone
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationInstitutionTelephone] (
[EducationOrganizationId] int NOT NULL ,
[InstitutionTelephoneNumberTypeId] int NOT NULL ,
[TelephoneNumber] nvarchar(24) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [InstitutionTelephoneNumberTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationInstitutionTelephone
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganizationInternationalAddress
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationInternationalAddress] (
[EducationOrganizationId] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[AddressLine1] nvarchar(150) NOT NULL ,
[AddressLine2] nvarchar(150) NULL ,
[AddressLine3] nvarchar(150) NULL ,
[AddressLine4] nvarchar(150) NULL ,
[CountryTypeId] int NOT NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationInternationalAddress
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganizationInterventionPrescriptionAssociation
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationInterventionPrescriptionAssociation] (
[EducationOrganizationId] int NOT NULL ,
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[InterventionPrescriptionEducationOrganizationId] int NOT NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [InterventionPrescriptionIdentificationCode], [InterventionPrescriptionEducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationInterventionPrescriptionAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_EducationOrganizationInterventionPrescriptionAssociation] ON [edfi].[EducationOrganizationInterventionPrescriptionAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationOrganizationNetwork
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationNetwork] (
[EducationOrganizationNetworkId] int NOT NULL ,
[NetworkPurposeTypeId] int NOT NULL ,
PRIMARY KEY ([EducationOrganizationNetworkId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationNetwork
-- ----------------------------

-- ----------------------------
-- Table structure for EducationOrganizationNetworkAssociation
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationNetworkAssociation] (
[MemberEducationOrganizationId] int NOT NULL ,
[EducationOrganizationNetworkId] int NOT NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([MemberEducationOrganizationId], [EducationOrganizationNetworkId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationNetworkAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_EducationOrganizationNetworkAssociation] ON [edfi].[EducationOrganizationNetworkAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationOrganizationPeerAssociation
-- ----------------------------

CREATE TABLE [edfi].[EducationOrganizationPeerAssociation] (
[EducationOrganizationId] int NOT NULL ,
[PeerEducationOrganizationId] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [PeerEducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationOrganizationPeerAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_EducationOrganizationPeerAssociation] ON [edfi].[EducationOrganizationPeerAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationPlanType
-- ----------------------------

CREATE TABLE [edfi].[EducationPlanType] (
[EducationPlanTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationPlanTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationPlanType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EducationPlanType_ShortDescription] ON [edfi].[EducationPlanType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EducationPlanType] ON [edfi].[EducationPlanType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EducationServiceCenter
-- ----------------------------

CREATE TABLE [edfi].[EducationServiceCenter] (
[EducationServiceCenterId] int NOT NULL ,
[StateEducationAgencyId] int NULL ,
PRIMARY KEY ([EducationServiceCenterId])
)


GO

-- ----------------------------
-- Indexes structure for table EducationServiceCenter
-- ----------------------------

-- ----------------------------
-- Table structure for ElectronicMailType
-- ----------------------------

CREATE TABLE [edfi].[ElectronicMailType] (
[ElectronicMailTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ElectronicMailTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ElectronicMailType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ElectronicMailType_ShortDescription] ON [edfi].[ElectronicMailType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ElectronicMailType] ON [edfi].[ElectronicMailType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EmploymentStatusDescriptor
-- ----------------------------

CREATE TABLE [edfi].[EmploymentStatusDescriptor] (
[EmploymentStatusDescriptorId] int NOT NULL ,
[EmploymentStatusTypeId] int NOT NULL ,
PRIMARY KEY ([EmploymentStatusDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table EmploymentStatusDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for EmploymentStatusType
-- ----------------------------

CREATE TABLE [edfi].[EmploymentStatusType] (
[EmploymentStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EmploymentStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EmploymentStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EmploymentStatusType_ShortDescription] ON [edfi].[EmploymentStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EmploymentStatusType] ON [edfi].[EmploymentStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EntryGradeLevelReasonType
-- ----------------------------

CREATE TABLE [edfi].[EntryGradeLevelReasonType] (
[EntryGradeLevelReasonTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EntryGradeLevelReasonTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EntryGradeLevelReasonType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EntryGradeLevelReasonType_ShortDescription] ON [edfi].[EntryGradeLevelReasonType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EntryGradeLevelReasonType] ON [edfi].[EntryGradeLevelReasonType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EntryType
-- ----------------------------

CREATE TABLE [edfi].[EntryType] (
[EntryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EntryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EntryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EntryType_ShortDescription] ON [edfi].[EntryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EntryType] ON [edfi].[EntryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for EntryTypeDescriptor
-- ----------------------------

CREATE TABLE [edfi].[EntryTypeDescriptor] (
[EntryTypeDescriptorId] int NOT NULL ,
[EntryTypeId] int NULL ,
PRIMARY KEY ([EntryTypeDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table EntryTypeDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for EventCircumstanceType
-- ----------------------------

CREATE TABLE [edfi].[EventCircumstanceType] (
[EventCircumstanceTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EventCircumstanceTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table EventCircumstanceType
-- ----------------------------
CREATE UNIQUE INDEX [AK_EventCircumstanceType_ShortDescription] ON [edfi].[EventCircumstanceType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_EventCircumstanceType] ON [edfi].[EventCircumstanceType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ExitWithdrawType
-- ----------------------------

CREATE TABLE [edfi].[ExitWithdrawType] (
[ExitWithdrawTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ExitWithdrawTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ExitWithdrawType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ExitWithdrawType_ShortDescription] ON [edfi].[ExitWithdrawType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ExitWithdrawType] ON [edfi].[ExitWithdrawType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ExitWithdrawTypeDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ExitWithdrawTypeDescriptor] (
[ExitWithdrawTypeDescriptorId] int NOT NULL ,
[ExitWithdrawTypeId] int NULL ,
PRIMARY KEY ([ExitWithdrawTypeDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ExitWithdrawTypeDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for FeederSchoolAssociation
-- ----------------------------

CREATE TABLE [edfi].[FeederSchoolAssociation] (
[SchoolId] int NOT NULL ,
[FeederSchoolId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[FeederRelationshipDescription] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [FeederSchoolId], [BeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table FeederSchoolAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_FeederSchoolAssociation] ON [edfi].[FeederSchoolAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Grade
-- ----------------------------

CREATE TABLE [edfi].[Grade] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[BeginDate] date NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[LetterGradeEarned] nvarchar(20) NULL ,
[NumericGradeEarned] int NULL ,
[DiagnosticStatement] nvarchar(1024) NULL ,
[GradeTypeId] int NOT NULL ,
[PerformanceBaseConversionTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [GradingPeriodEducationOrganizationId], [GradeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table Grade
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Grade] ON [edfi].[Grade]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GradebookEntry
-- ----------------------------

CREATE TABLE [edfi].[GradebookEntry] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[GradebookEntryTitle] nvarchar(60) NOT NULL ,
[DateAssigned] date NOT NULL ,
[Description] nvarchar(1024) NULL ,
[GradingPeriodDescriptorId] int NULL ,
[BeginDate] date NULL ,
[GradebookEntryTypeId] int NULL ,
[EducationOrganizationId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned])
)


GO

-- ----------------------------
-- Indexes structure for table GradebookEntry
-- ----------------------------
CREATE UNIQUE INDEX [GUID_GradebookEntry] ON [edfi].[GradebookEntry]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GradebookEntryLearningObjective
-- ----------------------------

CREATE TABLE [edfi].[GradebookEntryLearningObjective] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[GradebookEntryTitle] nvarchar(60) NOT NULL ,
[DateAssigned] date NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table GradebookEntryLearningObjective
-- ----------------------------

-- ----------------------------
-- Table structure for GradebookEntryLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[GradebookEntryLearningStandard] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[GradebookEntryTitle] nvarchar(60) NOT NULL ,
[DateAssigned] date NOT NULL ,
[LearningStandardId] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned], [LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table GradebookEntryLearningStandard
-- ----------------------------

-- ----------------------------
-- Table structure for GradebookEntryType
-- ----------------------------

CREATE TABLE [edfi].[GradebookEntryType] (
[GradebookEntryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([GradebookEntryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table GradebookEntryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_GradebookEntryType_ShortDescription] ON [edfi].[GradebookEntryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_GradebookEntryType] ON [edfi].[GradebookEntryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GradeLevelDescriptor
-- ----------------------------

CREATE TABLE [edfi].[GradeLevelDescriptor] (
[GradeLevelDescriptorId] int NOT NULL ,
[GradeLevelTypeId] int NOT NULL ,
PRIMARY KEY ([GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table GradeLevelDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for GradeLevelType
-- ----------------------------

CREATE TABLE [edfi].[GradeLevelType] (
[GradeLevelTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([GradeLevelTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table GradeLevelType
-- ----------------------------
CREATE UNIQUE INDEX [AK_GradeLevelType_ShortDescription] ON [edfi].[GradeLevelType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_GradeLevelType] ON [edfi].[GradeLevelType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GradeType
-- ----------------------------

CREATE TABLE [edfi].[GradeType] (
[GradeTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([GradeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table GradeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_GradeType_ShortDescription] ON [edfi].[GradeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_GradeType] ON [edfi].[GradeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GradingPeriod
-- ----------------------------

CREATE TABLE [edfi].[GradingPeriod] (
[EducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NOT NULL ,
[TotalInstructionalDays] int NOT NULL ,
[PeriodSequence] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table GradingPeriod
-- ----------------------------
CREATE UNIQUE INDEX [GUID_GradingPeriod] ON [edfi].[GradingPeriod]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_GradingPeriod_Type] ON [edfi].[GradingPeriod]
([EducationOrganizationId] ASC, [GradingPeriodDescriptorId] ASC) 
GO

-- ----------------------------
-- Table structure for GradingPeriodDescriptor
-- ----------------------------

CREATE TABLE [edfi].[GradingPeriodDescriptor] (
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodTypeId] int NOT NULL ,
PRIMARY KEY ([GradingPeriodDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table GradingPeriodDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for GradingPeriodType
-- ----------------------------

CREATE TABLE [edfi].[GradingPeriodType] (
[GradingPeriodTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[PeriodSequence] int NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([GradingPeriodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table GradingPeriodType
-- ----------------------------
CREATE UNIQUE INDEX [AK_GradingPeriodType_ShortDescription] ON [edfi].[GradingPeriodType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_GradingPeriodType] ON [edfi].[GradingPeriodType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GraduationPlan
-- ----------------------------

CREATE TABLE [edfi].[GraduationPlan] (
[EducationOrganizationId] int NOT NULL ,
[IndividualPlan] bit NULL ,
[TotalRequiredCredit] decimal(9,2) NOT NULL ,
[TotalRequiredCreditTypeId] int NULL ,
[TotalRequiredCreditConversion] decimal(9,2) NULL ,
[GraduationPlanTypeDescriptorId] int NOT NULL ,
[GraduationSchoolYear] smallint NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table GraduationPlan
-- ----------------------------
CREATE UNIQUE INDEX [GUID_GraduationPlan] ON [edfi].[GraduationPlan]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GraduationPlanCreditsByCourse
-- ----------------------------

CREATE TABLE [edfi].[GraduationPlanCreditsByCourse] (
[EducationOrganizationId] int NOT NULL ,
[Credit] decimal(9,2) NOT NULL ,
[CreditTypeId] int NULL ,
[CreditConversion] decimal(9,2) NULL ,
[GradeLevelDescriptorId] int NULL ,
[GraduationPlanTypeDescriptorId] int NOT NULL ,
[GraduationSchoolYear] smallint NOT NULL ,
[CourseSetName] nvarchar(120) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear], [CourseSetName])
)


GO

-- ----------------------------
-- Indexes structure for table GraduationPlanCreditsByCourse
-- ----------------------------

-- ----------------------------
-- Table structure for GraduationPlanCreditsByCourseCourse
-- ----------------------------

CREATE TABLE [edfi].[GraduationPlanCreditsByCourseCourse] (
[EducationOrganizationId] int NOT NULL ,
[GraduationPlanTypeDescriptorId] int NOT NULL ,
[GraduationSchoolYear] smallint NOT NULL ,
[CourseSetName] nvarchar(120) NOT NULL ,
[CourseEducationOrganizationId] int NOT NULL ,
[CourseCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear], [CourseSetName], [CourseEducationOrganizationId], [CourseCode])
)


GO

-- ----------------------------
-- Indexes structure for table GraduationPlanCreditsByCourseCourse
-- ----------------------------

-- ----------------------------
-- Table structure for GraduationPlanCreditsBySubject
-- ----------------------------

CREATE TABLE [edfi].[GraduationPlanCreditsBySubject] (
[EducationOrganizationId] int NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[Credit] decimal(9,2) NOT NULL ,
[CreditTypeId] int NULL ,
[CreditConversion] decimal(9,2) NULL ,
[GraduationPlanTypeDescriptorId] int NOT NULL ,
[GraduationSchoolYear] smallint NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [AcademicSubjectDescriptorId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table GraduationPlanCreditsBySubject
-- ----------------------------

-- ----------------------------
-- Table structure for GraduationPlanType
-- ----------------------------

CREATE TABLE [edfi].[GraduationPlanType] (
[GraduationPlanTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([GraduationPlanTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table GraduationPlanType
-- ----------------------------
CREATE UNIQUE INDEX [AK_GraduationPlanType_ShortDescription] ON [edfi].[GraduationPlanType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_GraduationPlanType] ON [edfi].[GraduationPlanType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for GraduationPlanTypeDescriptor
-- ----------------------------

CREATE TABLE [edfi].[GraduationPlanTypeDescriptor] (
[GraduationPlanTypeDescriptorId] int NOT NULL ,
[GraduationPlanTypeId] int NULL ,
PRIMARY KEY ([GraduationPlanTypeDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table GraduationPlanTypeDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for GunFreeSchoolsActReportingStatusType
-- ----------------------------

CREATE TABLE [edfi].[GunFreeSchoolsActReportingStatusType] (
[GunFreeSchoolsActReportingStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([GunFreeSchoolsActReportingStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table GunFreeSchoolsActReportingStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_GunFreeSchoolsActReportingStatusType_ShortDescription] ON [edfi].[GunFreeSchoolsActReportingStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_GunFreeSchoolsActReportingStatusType] ON [edfi].[GunFreeSchoolsActReportingStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for IdentificationDocumentUseType
-- ----------------------------

CREATE TABLE [edfi].[IdentificationDocumentUseType] (
[IdentificationDocumentUseTypeId] int NOT NULL IDENTITY(1,1) ,
[Description] nvarchar(1024) NULL ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([IdentificationDocumentUseTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table IdentificationDocumentUseType
-- ----------------------------
CREATE UNIQUE INDEX [AK_IdentificationDocumentUseType_ShortDescription] ON [edfi].[IdentificationDocumentUseType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_IdentificationDocumentUseType] ON [edfi].[IdentificationDocumentUseType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for IncidentLocationType
-- ----------------------------

CREATE TABLE [edfi].[IncidentLocationType] (
[IncidentLocationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([IncidentLocationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table IncidentLocationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_IncidentLocationType_ShortDescription] ON [edfi].[IncidentLocationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_IncidentLocationType] ON [edfi].[IncidentLocationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InstitutionTelephoneNumberType
-- ----------------------------

CREATE TABLE [edfi].[InstitutionTelephoneNumberType] (
[InstitutionTelephoneNumberTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InstitutionTelephoneNumberTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InstitutionTelephoneNumberType
-- ----------------------------
CREATE UNIQUE INDEX [AK_InstitutionTelephoneNumberType_ShortDescription] ON [edfi].[InstitutionTelephoneNumberType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_InstitutionTelephoneNumberType] ON [edfi].[InstitutionTelephoneNumberType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for IntegratedTechnologyStatusType
-- ----------------------------

CREATE TABLE [edfi].[IntegratedTechnologyStatusType] (
[IntegratedTechnologyStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([IntegratedTechnologyStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table IntegratedTechnologyStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_IntegratedTechnologyStatusType_ShortDescription] ON [edfi].[IntegratedTechnologyStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_IntegratedTechnologyStatusType] ON [edfi].[IntegratedTechnologyStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InteractivityStyleType
-- ----------------------------

CREATE TABLE [edfi].[InteractivityStyleType] (
[InteractivityStyleTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InteractivityStyleTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InteractivityStyleType
-- ----------------------------
CREATE UNIQUE INDEX [AK_InteractivityStyleType_ShortDescription] ON [edfi].[InteractivityStyleType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_InteractivityStyleType] ON [edfi].[InteractivityStyleType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InternetAccessType
-- ----------------------------

CREATE TABLE [edfi].[InternetAccessType] (
[InternetAccessTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[CodeValue] nvarchar(50) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InternetAccessTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InternetAccessType
-- ----------------------------
CREATE UNIQUE INDEX [AK_InternetAccessType_ShortDescription] ON [edfi].[InternetAccessType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_InternetAccessType] ON [edfi].[InternetAccessType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Intervention
-- ----------------------------

CREATE TABLE [edfi].[Intervention] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[InterventionClassTypeId] int NOT NULL ,
[DeliveryMethodTypeId] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[ShortDescription] nvarchar(75) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table Intervention
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Intervention] ON [edfi].[Intervention]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InterventionAppropriateGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[InterventionAppropriateGradeLevel] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionAppropriateGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionAppropriateSex
-- ----------------------------

CREATE TABLE [edfi].[InterventionAppropriateSex] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SexTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [SexTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionAppropriateSex
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionClassType
-- ----------------------------

CREATE TABLE [edfi].[InterventionClassType] (
[InterventionClassTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[CodeValue] nvarchar(50) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionClassTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionClassType
-- ----------------------------
CREATE UNIQUE INDEX [AK_InterventionClassType_ShortDescription] ON [edfi].[InterventionClassType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_InterventionClassType] ON [edfi].[InterventionClassType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InterventionDiagnosis
-- ----------------------------

CREATE TABLE [edfi].[InterventionDiagnosis] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[DiagnosisDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [DiagnosisDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionDiagnosis
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionEducationContent
-- ----------------------------

CREATE TABLE [edfi].[InterventionEducationContent] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[ContentIdentifier] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [ContentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionEducationContent
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionEffectivenessRatingType
-- ----------------------------

CREATE TABLE [edfi].[InterventionEffectivenessRatingType] (
[InterventionEffectivenessRatingTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[CodeValue] nvarchar(50) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionEffectivenessRatingTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionEffectivenessRatingType
-- ----------------------------
CREATE UNIQUE INDEX [AK_InterventionEffectivenessRatingType_ShortDescription] ON [edfi].[InterventionEffectivenessRatingType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_InterventionEffectivenessRatingType] ON [edfi].[InterventionEffectivenessRatingType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InterventionInterventionPrescription
-- ----------------------------

CREATE TABLE [edfi].[InterventionInterventionPrescription] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[InterventionPrescriptionEducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [InterventionPrescriptionIdentificationCode], [InterventionPrescriptionEducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionInterventionPrescription
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionLearningResourceMetadataURI
-- ----------------------------

CREATE TABLE [edfi].[InterventionLearningResourceMetadataURI] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[LearningResourceMetadataURI] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [LearningResourceMetadataURI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionLearningResourceMetadataURI
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionMeetingTime
-- ----------------------------

CREATE TABLE [edfi].[InterventionMeetingTime] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[AlternateDayName] nvarchar(20) NULL ,
[StartTime] time(7) NOT NULL ,
[EndTime] time(7) NOT NULL ,
[OfficialAttendancePeriod] bit NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [SchoolId], [ClassPeriodName])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionMeetingTime
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPopulationServed
-- ----------------------------

CREATE TABLE [edfi].[InterventionPopulationServed] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[PopulationServedTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [PopulationServedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPopulationServed
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescription
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescription] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[InterventionClassTypeId] int NOT NULL ,
[DeliveryMethodTypeId] int NOT NULL ,
[ShortDescription] nvarchar(75) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescription
-- ----------------------------
CREATE UNIQUE INDEX [GUID_InterventionPrescription] ON [edfi].[InterventionPrescription]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InterventionPrescriptionAppropriateGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionAppropriateGradeLevel] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionAppropriateGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescriptionAppropriateSex
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionAppropriateSex] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SexTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [SexTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionAppropriateSex
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescriptionDiagnosis
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionDiagnosis] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[DiagnosisDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [DiagnosisDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionDiagnosis
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescriptionEducationContent
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionEducationContent] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[ContentIdentifier] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [ContentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionEducationContent
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescriptionLearningResourceMetadataURI
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionLearningResourceMetadataURI] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[LearningResourceMetadataURI] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [LearningResourceMetadataURI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionLearningResourceMetadataURI
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescriptionPopulationServed
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionPopulationServed] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[PopulationServedTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [PopulationServedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionPopulationServed
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionPrescriptionURI
-- ----------------------------

CREATE TABLE [edfi].[InterventionPrescriptionURI] (
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[URI] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId], [URI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionPrescriptionURI
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStaff
-- ----------------------------

CREATE TABLE [edfi].[InterventionStaff] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[StaffUSI] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [StaffUSI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStaff
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudy
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudy] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[InterventionPrescriptionIdentificationCode] nvarchar(60) NOT NULL ,
[InterventionPrescriptionEducationOrganizationId] int NOT NULL ,
[Participants] int NOT NULL ,
[DeliveryMethodTypeId] int NOT NULL ,
[InterventionClassTypeId] int NOT NULL ,
[ShortDescription] nvarchar(75) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudy
-- ----------------------------
CREATE UNIQUE INDEX [GUID_InterventionStudy] ON [edfi].[InterventionStudy]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for InterventionStudyAppropriateGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyAppropriateGradeLevel] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyAppropriateGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyAppropriateSex
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyAppropriateSex] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SexTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [SexTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyAppropriateSex
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyEducationContent
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyEducationContent] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[ContentIdentifier] nvarchar(225) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [ContentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyEducationContent
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyInterventionEffectiveness
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyInterventionEffectiveness] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[DiagnosisDescriptorId] int NOT NULL ,
[PopulationServedTypeId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[ImprovementIndex] int NULL ,
[InterventionEffectivenessRatingTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [DiagnosisDescriptorId], [PopulationServedTypeId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyInterventionEffectiveness
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyLearningResourceMetadataURI
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyLearningResourceMetadataURI] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[LearningResourceMetadataURI] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [LearningResourceMetadataURI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyLearningResourceMetadataURI
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyPopulationServed
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyPopulationServed] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[PopulationServedTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [PopulationServedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyPopulationServed
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyStateAbbreviation
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyStateAbbreviation] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[StateAbbreviationTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [StateAbbreviationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyStateAbbreviation
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionStudyURI
-- ----------------------------

CREATE TABLE [edfi].[InterventionStudyURI] (
[InterventionStudyIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[URI] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId], [URI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionStudyURI
-- ----------------------------

-- ----------------------------
-- Table structure for InterventionURI
-- ----------------------------

CREATE TABLE [edfi].[InterventionURI] (
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[URI] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([InterventionIdentificationCode], [EducationOrganizationId], [URI])
)


GO

-- ----------------------------
-- Indexes structure for table InterventionURI
-- ----------------------------

-- ----------------------------
-- Table structure for LanguageDescriptor
-- ----------------------------

CREATE TABLE [edfi].[LanguageDescriptor] (
[LanguageDescriptorId] int NOT NULL ,
[LanguageTypeId] int NULL ,
PRIMARY KEY ([LanguageDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LanguageDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for LanguageType
-- ----------------------------

CREATE TABLE [edfi].[LanguageType] (
[LanguageTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LanguageTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LanguageType
-- ----------------------------
CREATE UNIQUE INDEX [AK_LanguageType_ShortDescription] ON [edfi].[LanguageType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_LanguageType] ON [edfi].[LanguageType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LanguageUseType
-- ----------------------------

CREATE TABLE [edfi].[LanguageUseType] (
[LanguageUseTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LanguageUseTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LanguageUseType
-- ----------------------------
CREATE UNIQUE INDEX [AK_LanguageUseType_ShortDescription] ON [edfi].[LanguageUseType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_LanguageUseType] ON [edfi].[LanguageUseType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LearningObjective
-- ----------------------------

CREATE TABLE [edfi].[LearningObjective] (
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[LearningObjectiveId] nvarchar(60) NULL ,
[Description] nvarchar(1024) NULL ,
[ParentObjective] nvarchar(60) NULL ,
[ParentAcademicSubjectDescriptorId] int NULL ,
[ParentObjectiveGradeLevelDescriptorId] int NULL ,
[Nomenclature] nvarchar(35) NULL ,
[SuccessCriteria] nvarchar(150) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LearningObjective
-- ----------------------------
CREATE UNIQUE INDEX [GUID_LearningObjective] ON [edfi].[LearningObjective]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LearningObjectiveContentStandard
-- ----------------------------

CREATE TABLE [edfi].[LearningObjectiveContentStandard] (
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[Title] nvarchar(75) NOT NULL ,
[Version] nvarchar(50) NULL ,
[URI] nvarchar(255) NULL ,
[PublicationDate] date NULL ,
[PublicationYear] smallint NULL ,
[PublicationStatusTypeId] int NULL ,
[MandatingEducationOrganizationId] int NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LearningObjectiveContentStandard
-- ----------------------------

-- ----------------------------
-- Table structure for LearningObjectiveContentStandardAuthor
-- ----------------------------

CREATE TABLE [edfi].[LearningObjectiveContentStandardAuthor] (
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[Author] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId], [Author])
)


GO

-- ----------------------------
-- Indexes structure for table LearningObjectiveContentStandardAuthor
-- ----------------------------

-- ----------------------------
-- Table structure for LearningObjectiveLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[LearningObjectiveLearningStandard] (
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[LearningStandardId] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId], [LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table LearningObjectiveLearningStandard
-- ----------------------------

-- ----------------------------
-- Table structure for LearningStandard
-- ----------------------------

CREATE TABLE [edfi].[LearningStandard] (
[LearningStandardId] nvarchar(60) NOT NULL ,
[ParentLearningStandardId] nvarchar(60) NULL ,
[Description] nvarchar(1024) NOT NULL ,
[LearningStandardItemCode] nvarchar(60) NULL ,
[URI] nvarchar(255) NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[CourseTitle] nvarchar(60) NULL ,
[SuccessCriteria] nvarchar(150) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table LearningStandard
-- ----------------------------
CREATE UNIQUE INDEX [GUID_LearningStandard] ON [edfi].[LearningStandard]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LearningStandardContentStandard
-- ----------------------------

CREATE TABLE [edfi].[LearningStandardContentStandard] (
[LearningStandardId] nvarchar(60) NOT NULL ,
[Title] nvarchar(75) NOT NULL ,
[Version] nvarchar(50) NULL ,
[URI] nvarchar(255) NULL ,
[PublicationDate] date NULL ,
[PublicationYear] smallint NULL ,
[PublicationStatusTypeId] int NULL ,
[MandatingEducationOrganizationId] int NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table LearningStandardContentStandard
-- ----------------------------

-- ----------------------------
-- Table structure for LearningStandardContentStandardAuthor
-- ----------------------------

CREATE TABLE [edfi].[LearningStandardContentStandardAuthor] (
[LearningStandardId] nvarchar(60) NOT NULL ,
[Author] nvarchar(255) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LearningStandardId], [Author])
)


GO

-- ----------------------------
-- Indexes structure for table LearningStandardContentStandardAuthor
-- ----------------------------

-- ----------------------------
-- Table structure for LearningStandardIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[LearningStandardIdentificationCode] (
[LearningStandardId] nvarchar(60) NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[ContentStandardName] nvarchar(65) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LearningStandardId], [IdentificationCode], [ContentStandardName])
)


GO

-- ----------------------------
-- Indexes structure for table LearningStandardIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for LearningStandardPrerequisiteLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[LearningStandardPrerequisiteLearningStandard] (
[LearningStandardId] nvarchar(60) NOT NULL ,
[PrerequisiteLearningStandardId] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LearningStandardId], [PrerequisiteLearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table LearningStandardPrerequisiteLearningStandard
-- ----------------------------

-- ----------------------------
-- Table structure for LeaveEvent
-- ----------------------------

CREATE TABLE [edfi].[LeaveEvent] (
[StaffUSI] int NOT NULL ,
[EventDate] date NOT NULL ,
[LeaveEventCategoryTypeId] int NOT NULL ,
[LeaveEventReason] nvarchar(40) NULL ,
[HoursOnLeave] decimal(18,2) NULL ,
[SubstituteAssigned] bit NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [EventDate], [LeaveEventCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LeaveEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_LeaveEvent] ON [edfi].[LeaveEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LeaveEventCategoryType
-- ----------------------------

CREATE TABLE [edfi].[LeaveEventCategoryType] (
[LeaveEventCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LeaveEventCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LeaveEventCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_LeaveEventCategoryType_ShortDescription] ON [edfi].[LeaveEventCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_LeaveEventCategoryType] ON [edfi].[LeaveEventCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LevelDescriptor
-- ----------------------------

CREATE TABLE [edfi].[LevelDescriptor] (
[LevelDescriptorId] int NOT NULL ,
PRIMARY KEY ([LevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LevelDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for LevelDescriptorGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[LevelDescriptorGradeLevel] (
[LevelDescriptorId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LevelDescriptorId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LevelDescriptorGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for LevelOfEducationDescriptor
-- ----------------------------

CREATE TABLE [edfi].[LevelOfEducationDescriptor] (
[LevelOfEducationDescriptorId] int NOT NULL ,
[LevelOfEducationTypeId] int NULL ,
PRIMARY KEY ([LevelOfEducationDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LevelOfEducationDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for LevelOfEducationType
-- ----------------------------

CREATE TABLE [edfi].[LevelOfEducationType] (
[LevelOfEducationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LevelOfEducationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LevelOfEducationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_LevelOfEducationType_ShortDescription] ON [edfi].[LevelOfEducationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_LevelOfEducationType] ON [edfi].[LevelOfEducationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LimitedEnglishProficiencyDescriptor
-- ----------------------------

CREATE TABLE [edfi].[LimitedEnglishProficiencyDescriptor] (
[LimitedEnglishProficiencyDescriptorId] int NOT NULL ,
[LimitedEnglishProficiencyTypeId] int NOT NULL ,
PRIMARY KEY ([LimitedEnglishProficiencyDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table LimitedEnglishProficiencyDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for LimitedEnglishProficiencyType
-- ----------------------------

CREATE TABLE [edfi].[LimitedEnglishProficiencyType] (
[LimitedEnglishProficiencyTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LimitedEnglishProficiencyTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LimitedEnglishProficiencyType
-- ----------------------------
CREATE UNIQUE INDEX [AK_LimitedEnglishProficiencyType_ShortDescription] ON [edfi].[LimitedEnglishProficiencyType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_LimitedEnglishProficiencyType] ON [edfi].[LimitedEnglishProficiencyType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LocalEducationAgency
-- ----------------------------

CREATE TABLE [edfi].[LocalEducationAgency] (
[LocalEducationAgencyId] int NOT NULL ,
[ParentLocalEducationAgencyId] int NULL ,
[LocalEducationAgencyCategoryTypeId] int NOT NULL ,
[CharterStatusTypeId] int NULL ,
[EducationServiceCenterId] int NULL ,
[StateEducationAgencyId] int NULL ,
PRIMARY KEY ([LocalEducationAgencyId])
)


GO

-- ----------------------------
-- Indexes structure for table LocalEducationAgency
-- ----------------------------

-- ----------------------------
-- Table structure for LocalEducationAgencyAccountability
-- ----------------------------

CREATE TABLE [edfi].[LocalEducationAgencyAccountability] (
[LocalEducationAgencyId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[GunFreeSchoolsActReportingStatusTypeId] int NULL ,
[SchoolChoiceImplementStatusTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LocalEducationAgencyId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table LocalEducationAgencyAccountability
-- ----------------------------

-- ----------------------------
-- Table structure for LocalEducationAgencyCategoryType
-- ----------------------------

CREATE TABLE [edfi].[LocalEducationAgencyCategoryType] (
[LocalEducationAgencyCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LocalEducationAgencyCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table LocalEducationAgencyCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_LocalEducationAgencyCategoryType_ShortDescription] ON [edfi].[LocalEducationAgencyCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_LocalEducationAgencyCategoryType] ON [edfi].[LocalEducationAgencyCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for LocalEducationAgencyFederalFunds
-- ----------------------------

CREATE TABLE [edfi].[LocalEducationAgencyFederalFunds] (
[LocalEducationAgencyId] int NOT NULL ,
[FiscalYear] int NOT NULL ,
[InnovativeDollarsSpent] money NULL ,
[InnovativeDollarsSpentOnStrategicPriorities] money NULL ,
[InnovativeProgramsFundsReceived] money NULL ,
[SchoolImprovementAllocation] money NULL ,
[SupplementalEducationalServicesFundsSpent] money NULL ,
[SupplementalEducationalServicesPerPupilExpenditure] money NULL ,
[SchoolImprovementReservedFundsPercentage] decimal(5,4) NULL ,
[StateAssessmentAdministrationFunding] decimal(5,4) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([LocalEducationAgencyId], [FiscalYear])
)


GO

-- ----------------------------
-- Indexes structure for table LocalEducationAgencyFederalFunds
-- ----------------------------
CREATE UNIQUE INDEX [GUID_LocalEducationAgencyFederalFunds] ON [edfi].[LocalEducationAgencyFederalFunds]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Location
-- ----------------------------

CREATE TABLE [edfi].[Location] (
[SchoolId] int NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[MaximumNumberOfSeats] int NULL ,
[OptimalNumberOfSeats] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassroomIdentificationCode])
)


GO

-- ----------------------------
-- Indexes structure for table Location
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Location] ON [edfi].[Location]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for MagnetSpecialProgramEmphasisSchoolType
-- ----------------------------

CREATE TABLE [edfi].[MagnetSpecialProgramEmphasisSchoolType] (
[MagnetSpecialProgramEmphasisSchoolTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([MagnetSpecialProgramEmphasisSchoolTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table MagnetSpecialProgramEmphasisSchoolType
-- ----------------------------
CREATE UNIQUE INDEX [AK_MagnetSpecialProgramEmphasisSchoolType_ShortDescription] ON [edfi].[MagnetSpecialProgramEmphasisSchoolType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_MagnetSpecialProgramEmphasisSchoolType] ON [edfi].[MagnetSpecialProgramEmphasisSchoolType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for MediumOfInstructionType
-- ----------------------------

CREATE TABLE [edfi].[MediumOfInstructionType] (
[MediumOfInstructionTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([MediumOfInstructionTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table MediumOfInstructionType
-- ----------------------------
CREATE UNIQUE INDEX [AK_MediumOfInstructionType_ShortDescription] ON [edfi].[MediumOfInstructionType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_MediumOfInstructionType] ON [edfi].[MediumOfInstructionType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for MeetingDayType
-- ----------------------------

CREATE TABLE [edfi].[MeetingDayType] (
[MeetingDayTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([MeetingDayTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table MeetingDayType
-- ----------------------------
CREATE UNIQUE INDEX [AK_MeetingDayType_ShortDescription] ON [edfi].[MeetingDayType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_MeetingDayType] ON [edfi].[MeetingDayType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for MethodCreditEarnedType
-- ----------------------------

CREATE TABLE [edfi].[MethodCreditEarnedType] (
[MethodCreditEarnedTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([MethodCreditEarnedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table MethodCreditEarnedType
-- ----------------------------
CREATE UNIQUE INDEX [AK_MethodCreditEarnedType_ShortDescription] ON [edfi].[MethodCreditEarnedType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_MethodCreditEarnedType] ON [edfi].[MethodCreditEarnedType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for NetworkPurposeType
-- ----------------------------

CREATE TABLE [edfi].[NetworkPurposeType] (
[NetworkPurposeTypeId] int NOT NULL IDENTITY(1,1) ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[CodeValue] nvarchar(50) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([NetworkPurposeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table NetworkPurposeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_NetworkPurposeType_ShortDescription] ON [edfi].[NetworkPurposeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_NetworkPurposeType] ON [edfi].[NetworkPurposeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ObjectiveAssessment
-- ----------------------------

CREATE TABLE [edfi].[ObjectiveAssessment] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[ParentIdentificationCode] nvarchar(60) NULL ,
[MaxRawScore] int NULL ,
[PercentOfAssessment] decimal(6,2) NULL ,
[Nomenclature] nvarchar(35) NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode])
)


GO

-- ----------------------------
-- Indexes structure for table ObjectiveAssessment
-- ----------------------------
CREATE UNIQUE INDEX [GUID_ObjectiveAssessment] ON [edfi].[ObjectiveAssessment]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ObjectiveAssessmentAssessmentItem
-- ----------------------------

CREATE TABLE [edfi].[ObjectiveAssessmentAssessmentItem] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[AssessmentItemIdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AssessmentItemIdentificationCode])
)


GO

-- ----------------------------
-- Indexes structure for table ObjectiveAssessmentAssessmentItem
-- ----------------------------

-- ----------------------------
-- Table structure for ObjectiveAssessmentLearningObjective
-- ----------------------------

CREATE TABLE [edfi].[ObjectiveAssessmentLearningObjective] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [Objective])
)


GO

-- ----------------------------
-- Indexes structure for table ObjectiveAssessmentLearningObjective
-- ----------------------------

-- ----------------------------
-- Table structure for ObjectiveAssessmentLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[ObjectiveAssessmentLearningStandard] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[LearningStandardId] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [LearningStandardId])
)


GO

-- ----------------------------
-- Indexes structure for table ObjectiveAssessmentLearningStandard
-- ----------------------------

-- ----------------------------
-- Table structure for ObjectiveAssessmentPerformanceLevel
-- ----------------------------

CREATE TABLE [edfi].[ObjectiveAssessmentPerformanceLevel] (
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[PerformanceLevelDescriptorId] int NOT NULL ,
[AssessmentReportingMethodTypeId] int NOT NULL ,
[MinimumScore] nvarchar(35) NULL ,
[MaximumScore] nvarchar(35) NULL ,
[ResultDatatypeTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [PerformanceLevelDescriptorId], [AssessmentReportingMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ObjectiveAssessmentPerformanceLevel
-- ----------------------------

-- ----------------------------
-- Table structure for OldEthnicityType
-- ----------------------------

CREATE TABLE [edfi].[OldEthnicityType] (
[OldEthnicityTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([OldEthnicityTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table OldEthnicityType
-- ----------------------------
CREATE UNIQUE INDEX [AK_OldEthnicityType_ShortDescription] ON [edfi].[OldEthnicityType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_OldEthnicityType] ON [edfi].[OldEthnicityType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for OpenStaffPosition
-- ----------------------------

CREATE TABLE [edfi].[OpenStaffPosition] (
[EducationOrganizationId] int NOT NULL ,
[EmploymentStatusDescriptorId] int NOT NULL ,
[StaffClassificationDescriptorId] int NOT NULL ,
[RequisitionNumber] nvarchar(20) NOT NULL ,
[DatePosted] date NOT NULL ,
[PositionTitle] nvarchar(100) NULL ,
[ProgramAssignmentDescriptorId] int NULL ,
[DatePostingRemoved] date NULL ,
[PostingResultTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [EmploymentStatusDescriptorId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted])
)


GO

-- ----------------------------
-- Indexes structure for table OpenStaffPosition
-- ----------------------------
CREATE UNIQUE INDEX [GUID_OpenStaffPosition] ON [edfi].[OpenStaffPosition]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for OpenStaffPositionAcademicSubject
-- ----------------------------

CREATE TABLE [edfi].[OpenStaffPositionAcademicSubject] (
[EducationOrganizationId] int NOT NULL ,
[StaffClassificationDescriptorId] int NOT NULL ,
[RequisitionNumber] nvarchar(20) NOT NULL ,
[DatePosted] date NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[EmploymentStatusDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted], [AcademicSubjectDescriptorId], [EmploymentStatusDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table OpenStaffPositionAcademicSubject
-- ----------------------------

-- ----------------------------
-- Table structure for OpenStaffPositionInstructionalGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[OpenStaffPositionInstructionalGradeLevel] (
[EducationOrganizationId] int NOT NULL ,
[StaffClassificationDescriptorId] int NOT NULL ,
[RequisitionNumber] nvarchar(20) NOT NULL ,
[DatePosted] date NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[EmploymentStatusDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted], [GradeLevelDescriptorId], [EmploymentStatusDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table OpenStaffPositionInstructionalGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for OperationalStatusType
-- ----------------------------

CREATE TABLE [edfi].[OperationalStatusType] (
[OperationalStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([OperationalStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table OperationalStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_OperationalStatusType_ShortDescription] ON [edfi].[OperationalStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_OperationalStatusType] ON [edfi].[OperationalStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for OtherNameType
-- ----------------------------

CREATE TABLE [edfi].[OtherNameType] (
[OtherNameTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([OtherNameTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table OtherNameType
-- ----------------------------
CREATE UNIQUE INDEX [AK_OtherNameType_ShortDescription] ON [edfi].[OtherNameType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_OtherNameType] ON [edfi].[OtherNameType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Parent
-- ----------------------------

CREATE TABLE [edfi].[Parent] (
[ParentUSI] int NOT NULL IDENTITY(1,1) ,
[PersonalTitlePrefix] nvarchar(75) NULL ,
[FirstName] nvarchar(75) NOT NULL ,
[MiddleName] nvarchar(75) NULL ,
[LastSurname] nvarchar(75) NOT NULL ,
[GenerationCodeSuffix] nvarchar(75) NULL ,
[MaidenName] nvarchar(75) NULL ,
[SexTypeId] int NULL ,
[LoginId] nvarchar(60) NULL ,
[ParentUniqueId] nvarchar(32) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ParentUSI])
)


GO

-- ----------------------------
-- Indexes structure for table Parent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Parent] ON [edfi].[Parent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [UI_Parent_ParentUniqueId] ON [edfi].[Parent]
([ParentUniqueId] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ParentAddress
-- ----------------------------

CREATE TABLE [edfi].[ParentAddress] (
[ParentUSI] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[StreetNumberName] nvarchar(150) NOT NULL ,
[ApartmentRoomSuiteNumber] nvarchar(50) NULL ,
[BuildingSiteNumber] nvarchar(20) NULL ,
[City] nvarchar(30) NOT NULL ,
[StateAbbreviationTypeId] int NOT NULL ,
[PostalCode] nvarchar(17) NOT NULL ,
[NameOfCounty] nvarchar(30) NULL ,
[CountyFIPSCode] nvarchar(5) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ParentUSI], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ParentAddress
-- ----------------------------

-- ----------------------------
-- Table structure for ParentElectronicMail
-- ----------------------------

CREATE TABLE [edfi].[ParentElectronicMail] (
[ParentUSI] int NOT NULL ,
[ElectronicMailTypeId] int NOT NULL ,
[ElectronicMailAddress] nvarchar(128) NOT NULL ,
[PrimaryEmailAddressIndicator] bit NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ParentUSI], [ElectronicMailTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ParentElectronicMail
-- ----------------------------

-- ----------------------------
-- Table structure for ParentIdentificationDocument
-- ----------------------------

CREATE TABLE [edfi].[ParentIdentificationDocument] (
[DocumentTitle] nvarchar(60) NULL ,
[PersonalInformationVerificationTypeId] int NOT NULL ,
[DocumentExpirationDate] date NULL ,
[IssuerDocumentIdentificationCode] nvarchar(60) NULL ,
[IssuerName] nvarchar(150) NULL ,
[IdentificationDocumentUseTypeId] int NOT NULL ,
[ParentUSI] int NOT NULL ,
[IssuerCountryTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PersonalInformationVerificationTypeId], [IdentificationDocumentUseTypeId], [ParentUSI])
)


GO

-- ----------------------------
-- Indexes structure for table ParentIdentificationDocument
-- ----------------------------

-- ----------------------------
-- Table structure for ParentInternationalAddress
-- ----------------------------

CREATE TABLE [edfi].[ParentInternationalAddress] (
[ParentUSI] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[AddressLine1] nvarchar(150) NOT NULL ,
[AddressLine2] nvarchar(150) NULL ,
[AddressLine3] nvarchar(150) NULL ,
[AddressLine4] nvarchar(150) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CountryTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ParentUSI], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ParentInternationalAddress
-- ----------------------------

-- ----------------------------
-- Table structure for ParentOtherName
-- ----------------------------

CREATE TABLE [edfi].[ParentOtherName] (
[ParentUSI] int NOT NULL ,
[OtherNameTypeId] int NOT NULL ,
[PersonalTitlePrefix] nvarchar(75) NULL ,
[FirstName] nvarchar(75) NOT NULL ,
[MiddleName] nvarchar(75) NULL ,
[LastSurname] nvarchar(75) NOT NULL ,
[GenerationCodeSuffix] nvarchar(75) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ParentUSI], [OtherNameTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ParentOtherName
-- ----------------------------

-- ----------------------------
-- Table structure for ParentTelephone
-- ----------------------------

CREATE TABLE [edfi].[ParentTelephone] (
[ParentUSI] int NOT NULL ,
[TelephoneNumberTypeId] int NOT NULL ,
[OrderOfPriority] int NULL ,
[TextMessageCapabilityIndicator] bit NULL ,
[TelephoneNumber] nvarchar(24) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ParentUSI], [TelephoneNumberTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ParentTelephone
-- ----------------------------

-- ----------------------------
-- Table structure for Payroll
-- ----------------------------

CREATE TABLE [edfi].[Payroll] (
[StaffUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[AccountNumber] nvarchar(50) NOT NULL ,
[FiscalYear] int NOT NULL ,
[AsOfDate] date NOT NULL ,
[AmountToDate] money NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [EducationOrganizationId], [AccountNumber], [FiscalYear], [AsOfDate])
)


GO

-- ----------------------------
-- Indexes structure for table Payroll
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Payroll] ON [edfi].[Payroll]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PerformanceBaseConversionType
-- ----------------------------

CREATE TABLE [edfi].[PerformanceBaseConversionType] (
[PerformanceBaseConversionTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PerformanceBaseConversionTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PerformanceBaseConversionType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PerformanceBaseConversionType_ShortDescription] ON [edfi].[PerformanceBaseConversionType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PerformanceBaseConversionType] ON [edfi].[PerformanceBaseConversionType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PerformanceLevelDescriptor
-- ----------------------------

CREATE TABLE [edfi].[PerformanceLevelDescriptor] (
[PerformanceLevelDescriptorId] int NOT NULL ,
[PerformanceBaseConversionTypeId] int NULL ,
PRIMARY KEY ([PerformanceLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table PerformanceLevelDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for PersonalInformationVerificationType
-- ----------------------------

CREATE TABLE [edfi].[PersonalInformationVerificationType] (
[PersonalInformationVerificationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PersonalInformationVerificationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PersonalInformationVerificationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PersonalInformationVerificationType_ShortDescription] ON [edfi].[PersonalInformationVerificationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PersonalInformationVerificationType] ON [edfi].[PersonalInformationVerificationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PopulationServedType
-- ----------------------------

CREATE TABLE [edfi].[PopulationServedType] (
[PopulationServedTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PopulationServedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PopulationServedType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PopulationServedType_ShortDescription] ON [edfi].[PopulationServedType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PopulationServedType] ON [edfi].[PopulationServedType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PostingResultType
-- ----------------------------

CREATE TABLE [edfi].[PostingResultType] (
[PostingResultTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PostingResultTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PostingResultType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PostingResultType_ShortDescription] ON [edfi].[PostingResultType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PostingResultType] ON [edfi].[PostingResultType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PostSecondaryEvent
-- ----------------------------

CREATE TABLE [edfi].[PostSecondaryEvent] (
[StudentUSI] int NOT NULL ,
[PostSecondaryEventCategoryTypeId] int NOT NULL ,
[EventDate] date NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate])
)


GO

-- ----------------------------
-- Indexes structure for table PostSecondaryEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_PostSecondaryEvent] ON [edfi].[PostSecondaryEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PostSecondaryEventCategoryType
-- ----------------------------

CREATE TABLE [edfi].[PostSecondaryEventCategoryType] (
[PostSecondaryEventCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PostSecondaryEventCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PostSecondaryEventCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PostSecondaryEventCategoryType_ShortDescription] ON [edfi].[PostSecondaryEventCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PostSecondaryEventCategoryType] ON [edfi].[PostSecondaryEventCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PostSecondaryEventPostSecondaryInstitution
-- ----------------------------

CREATE TABLE [edfi].[PostSecondaryEventPostSecondaryInstitution] (
[StudentUSI] int NOT NULL ,
[PostSecondaryEventCategoryTypeId] int NOT NULL ,
[EventDate] date NOT NULL ,
[NameOfInstitution] nvarchar(75) NOT NULL ,
[PostSecondaryInstitutionId] nvarchar(30) NULL ,
[PostSecondaryInstitutionLevelTypeId] int NULL ,
[AdministrativeFundingControlDescriptorId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate])
)


GO

-- ----------------------------
-- Indexes structure for table PostSecondaryEventPostSecondaryInstitution
-- ----------------------------

-- ----------------------------
-- Table structure for PostSecondaryEventPostSecondaryInstitutionIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[PostSecondaryEventPostSecondaryInstitutionIdentificationCode] (
[StudentUSI] int NOT NULL ,
[PostSecondaryEventCategoryTypeId] int NOT NULL ,
[EventDate] date NOT NULL ,
[EducationOrganizationIdentificationSystemTypeId] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate], [EducationOrganizationIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PostSecondaryEventPostSecondaryInstitutionIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction
-- ----------------------------

CREATE TABLE [edfi].[PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction] (
[StudentUSI] int NOT NULL ,
[PostSecondaryEventCategoryTypeId] int NOT NULL ,
[EventDate] date NOT NULL ,
[MediumOfInstructionTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate], [MediumOfInstructionTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction
-- ----------------------------

-- ----------------------------
-- Table structure for PostSecondaryInstitutionLevelType
-- ----------------------------

CREATE TABLE [edfi].[PostSecondaryInstitutionLevelType] (
[PostSecondaryInstitutionLevelTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PostSecondaryInstitutionLevelTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PostSecondaryInstitutionLevelType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PostSecondaryInstitutionLevelType_ShortDescription] ON [edfi].[PostSecondaryInstitutionLevelType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PostSecondaryInstitutionLevelType] ON [edfi].[PostSecondaryInstitutionLevelType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Program
-- ----------------------------

CREATE TABLE [edfi].[Program] (
[EducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[ProgramId] nvarchar(20) NULL ,
[ProgramSponsorTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table Program
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Program] ON [edfi].[Program]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ProgramAssignmentDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ProgramAssignmentDescriptor] (
[ProgramAssignmentDescriptorId] int NOT NULL ,
[ProgramAssignmentTypeId] int NULL ,
PRIMARY KEY ([ProgramAssignmentDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramAssignmentDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ProgramAssignmentType
-- ----------------------------

CREATE TABLE [edfi].[ProgramAssignmentType] (
[ProgramAssignmentTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ProgramAssignmentTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramAssignmentType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ProgramAssignmentType_ShortDescription] ON [edfi].[ProgramAssignmentType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ProgramAssignmentType] ON [edfi].[ProgramAssignmentType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ProgramCharacteristic
-- ----------------------------

CREATE TABLE [edfi].[ProgramCharacteristic] (
[EducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramCharacteristicDescriptorId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramCharacteristicDescriptorId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramCharacteristic
-- ----------------------------

-- ----------------------------
-- Table structure for ProgramCharacteristicDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ProgramCharacteristicDescriptor] (
[ProgramCharacteristicDescriptorId] int NOT NULL ,
[ProgramCharacteristicTypeId] int NOT NULL ,
PRIMARY KEY ([ProgramCharacteristicDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramCharacteristicDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ProgramCharacteristicType
-- ----------------------------

CREATE TABLE [edfi].[ProgramCharacteristicType] (
[ProgramCharacteristicTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ProgramCharacteristicTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramCharacteristicType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ProgramCharacteristicType_ShortDescription] ON [edfi].[ProgramCharacteristicType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ProgramCharacteristicType] ON [edfi].[ProgramCharacteristicType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ProgramLearningObjective
-- ----------------------------

CREATE TABLE [edfi].[ProgramLearningObjective] (
[EducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [ProgramTypeId], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramLearningObjective
-- ----------------------------

-- ----------------------------
-- Table structure for ProgramLearningStandard
-- ----------------------------

CREATE TABLE [edfi].[ProgramLearningStandard] (
[EducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[LearningStandardId] nvarchar(60) NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [ProgramTypeId], [LearningStandardId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramLearningStandard
-- ----------------------------

-- ----------------------------
-- Table structure for ProgramService
-- ----------------------------

CREATE TABLE [edfi].[ProgramService] (
[EducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ServiceDescriptorId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [ProgramTypeId], [ServiceDescriptorId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramService
-- ----------------------------

-- ----------------------------
-- Table structure for ProgramSponsorType
-- ----------------------------

CREATE TABLE [edfi].[ProgramSponsorType] (
[ProgramSponsorTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ProgramSponsorTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramSponsorType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ProgramSponsorType_ShortDescription] ON [edfi].[ProgramSponsorType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ProgramSponsorType] ON [edfi].[ProgramSponsorType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ProgramType
-- ----------------------------

CREATE TABLE [edfi].[ProgramType] (
[ProgramTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ProgramTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ProgramType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ProgramType_ShortDescription] ON [edfi].[ProgramType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ProgramType] ON [edfi].[ProgramType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for PublicationStatusType
-- ----------------------------

CREATE TABLE [edfi].[PublicationStatusType] (
[PublicationStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PublicationStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table PublicationStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_PublicationStatusType_ShortDescription] ON [edfi].[PublicationStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_PublicationStatusType] ON [edfi].[PublicationStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RaceType
-- ----------------------------

CREATE TABLE [edfi].[RaceType] (
[RaceTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RaceTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RaceType
-- ----------------------------
CREATE UNIQUE INDEX [AK_RaceType_ShortDescription] ON [edfi].[RaceType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_RaceType] ON [edfi].[RaceType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ReasonExitedDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ReasonExitedDescriptor] (
[ReasonExitedDescriptorId] int NOT NULL ,
[ReasonExitedTypeId] int NULL ,
PRIMARY KEY ([ReasonExitedDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ReasonExitedDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ReasonExitedType
-- ----------------------------

CREATE TABLE [edfi].[ReasonExitedType] (
[ReasonExitedTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ReasonExitedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ReasonExitedType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ReasonExitedType_ShortDescription] ON [edfi].[ReasonExitedType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ReasonExitedType] ON [edfi].[ReasonExitedType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ReasonNotTestedType
-- ----------------------------

CREATE TABLE [edfi].[ReasonNotTestedType] (
[ReasonNotTestedTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ReasonNotTestedTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ReasonNotTestedType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ReasonNotTestedType_ShortDescription] ON [edfi].[ReasonNotTestedType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ReasonNotTestedType] ON [edfi].[ReasonNotTestedType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RecognitionType
-- ----------------------------

CREATE TABLE [edfi].[RecognitionType] (
[RecognitionTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RecognitionTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RecognitionType
-- ----------------------------
CREATE UNIQUE INDEX [AK_RecognitionType_ShortDescription] ON [edfi].[RecognitionType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_RecognitionType] ON [edfi].[RecognitionType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RelationType
-- ----------------------------

CREATE TABLE [edfi].[RelationType] (
[RelationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RelationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RelationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_RelationType_ShortDescription] ON [edfi].[RelationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_RelationType] ON [edfi].[RelationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RepeatIdentifierType
-- ----------------------------

CREATE TABLE [edfi].[RepeatIdentifierType] (
[RepeatIdentifierTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RepeatIdentifierTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RepeatIdentifierType
-- ----------------------------
CREATE UNIQUE INDEX [AK_RepeatIdentifierType_ShortDescription] ON [edfi].[RepeatIdentifierType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_RepeatIdentifierType] ON [edfi].[RepeatIdentifierType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ReportCard
-- ----------------------------

CREATE TABLE [edfi].[ReportCard] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[GPAGivenGradingPeriod] decimal(18,4) NULL ,
[GPACumulative] decimal(18,4) NULL ,
[NumberOfDaysAbsent] decimal(18,4) NULL ,
[NumberOfDaysInAttendance] decimal(18,4) NULL ,
[NumberOfDaysTardy] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table ReportCard
-- ----------------------------
CREATE UNIQUE INDEX [GUID_ReportCard] ON [edfi].[ReportCard]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ReportCardGrade
-- ----------------------------

CREATE TABLE [edfi].[ReportCardGrade] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[BeginDate] date NOT NULL ,
[GradeTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate], [GradeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ReportCardGrade
-- ----------------------------

-- ----------------------------
-- Table structure for ReportCardStudentCompetencyObjective
-- ----------------------------

CREATE TABLE [edfi].[ReportCardStudentCompetencyObjective] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[ObjectiveEducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [ObjectiveGradeLevelDescriptorId], [ObjectiveEducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table ReportCardStudentCompetencyObjective
-- ----------------------------

-- ----------------------------
-- Table structure for ReportCardStudentLearningObjective
-- ----------------------------

CREATE TABLE [edfi].[ReportCardStudentLearningObjective] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ReportCardStudentLearningObjective
-- ----------------------------

-- ----------------------------
-- Table structure for ReporterDescriptionDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ReporterDescriptionDescriptor] (
[ReporterDescriptionDescriptorId] int NOT NULL ,
[ReporterDescriptionTypeId] int NULL ,
PRIMARY KEY ([ReporterDescriptionDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ReporterDescriptionDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ReporterDescriptionType
-- ----------------------------

CREATE TABLE [edfi].[ReporterDescriptionType] (
[ReporterDescriptionTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ReporterDescriptionTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ReporterDescriptionType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ReporterDescriptionType_ShortDescription] ON [edfi].[ReporterDescriptionType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ReporterDescriptionType] ON [edfi].[ReporterDescriptionType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ResidencyStatusDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ResidencyStatusDescriptor] (
[ResidencyStatusDescriptorId] int NOT NULL ,
[ResidencyStatusTypeId] int NULL ,
PRIMARY KEY ([ResidencyStatusDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ResidencyStatusDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ResidencyStatusType
-- ----------------------------

CREATE TABLE [edfi].[ResidencyStatusType] (
[ResidencyStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ResidencyStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ResidencyStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ResidencyStatusType_ShortDescription] ON [edfi].[ResidencyStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ResidencyStatusType] ON [edfi].[ResidencyStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ResponseIndicatorType
-- ----------------------------

CREATE TABLE [edfi].[ResponseIndicatorType] (
[ResponseIndicatorTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ResponseIndicatorTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ResponseIndicatorType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ResponseIndicatorType_ShortDescription] ON [edfi].[ResponseIndicatorType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ResponseIndicatorType] ON [edfi].[ResponseIndicatorType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ResponsibilityDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ResponsibilityDescriptor] (
[ResponsibilityDescriptorId] int NOT NULL ,
[ResponsibilityTypeId] int NULL ,
PRIMARY KEY ([ResponsibilityDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ResponsibilityDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for ResponsibilityType
-- ----------------------------

CREATE TABLE [edfi].[ResponsibilityType] (
[ResponsibilityTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ResponsibilityTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ResponsibilityType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ResponsibilityType_ShortDescription] ON [edfi].[ResponsibilityType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ResponsibilityType] ON [edfi].[ResponsibilityType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RestraintEvent
-- ----------------------------

CREATE TABLE [edfi].[RestraintEvent] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[RestraintEventIdentifier] nvarchar(20) NOT NULL ,
[EventDate] date NOT NULL ,
[EducationalEnvironmentTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate])
)


GO

-- ----------------------------
-- Indexes structure for table RestraintEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_RestraintEvent] ON [edfi].[RestraintEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RestraintEventProgram
-- ----------------------------

CREATE TABLE [edfi].[RestraintEventProgram] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[RestraintEventIdentifier] nvarchar(20) NOT NULL ,
[EventDate] date NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate], [ProgramTypeId], [ProgramName], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table RestraintEventProgram
-- ----------------------------

-- ----------------------------
-- Table structure for RestraintEventReason
-- ----------------------------

CREATE TABLE [edfi].[RestraintEventReason] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[RestraintEventIdentifier] nvarchar(20) NOT NULL ,
[EventDate] date NOT NULL ,
[RestraintEventReasonTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate], [RestraintEventReasonTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RestraintEventReason
-- ----------------------------

-- ----------------------------
-- Table structure for RestraintEventReasonType
-- ----------------------------

CREATE TABLE [edfi].[RestraintEventReasonType] (
[RestraintEventReasonTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RestraintEventReasonTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RestraintEventReasonType
-- ----------------------------
CREATE UNIQUE INDEX [AK_RestraintEventReasonType_ShortDescription] ON [edfi].[RestraintEventReasonType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_RestraintEventReasonType] ON [edfi].[RestraintEventReasonType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ResultDatatypeType
-- ----------------------------

CREATE TABLE [edfi].[ResultDatatypeType] (
[ResultDatatypeTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ResultDatatypeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table ResultDatatypeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_ResultDatatypeType_ShortDescription] ON [edfi].[ResultDatatypeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_ResultDatatypeType] ON [edfi].[ResultDatatypeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for RetestIndicatorType
-- ----------------------------

CREATE TABLE [edfi].[RetestIndicatorType] (
[RetestIndicatorTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RetestIndicatorTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table RetestIndicatorType
-- ----------------------------
CREATE UNIQUE INDEX [AK_RetestIndicatorType_ShortDescription] ON [edfi].[RetestIndicatorType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_RetestIndicatorType] ON [edfi].[RetestIndicatorType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for School
-- ----------------------------

CREATE TABLE [edfi].[School] (
[SchoolId] int NOT NULL ,
[LocalEducationAgencyId] int NULL ,
[SchoolTypeId] int NULL ,
[CharterStatusTypeId] int NULL ,
[TitleIPartASchoolDesignationTypeId] int NULL ,
[MagnetSpecialProgramEmphasisSchoolTypeId] int NULL ,
[AdministrativeFundingControlDescriptorId] int NULL ,
[InternetAccessTypeId] int NULL ,
PRIMARY KEY ([SchoolId])
)


GO

-- ----------------------------
-- Indexes structure for table School
-- ----------------------------

-- ----------------------------
-- Table structure for SchoolCategory
-- ----------------------------

CREATE TABLE [edfi].[SchoolCategory] (
[SchoolId] int NOT NULL ,
[SchoolCategoryTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [SchoolCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolCategory
-- ----------------------------

-- ----------------------------
-- Table structure for SchoolCategoryType
-- ----------------------------

CREATE TABLE [edfi].[SchoolCategoryType] (
[SchoolCategoryTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolCategoryTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolCategoryType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SchoolCategoryType_ShortDescription] ON [edfi].[SchoolCategoryType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SchoolCategoryType] ON [edfi].[SchoolCategoryType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SchoolChoiceImplementStatusType
-- ----------------------------

CREATE TABLE [edfi].[SchoolChoiceImplementStatusType] (
[SchoolChoiceImplementStatusTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolChoiceImplementStatusTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolChoiceImplementStatusType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SchoolChoiceImplementStatusType_ShortDescription] ON [edfi].[SchoolChoiceImplementStatusType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SchoolChoiceImplementStatusType] ON [edfi].[SchoolChoiceImplementStatusType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SchoolFoodServicesEligibilityDescriptor
-- ----------------------------

CREATE TABLE [edfi].[SchoolFoodServicesEligibilityDescriptor] (
[SchoolFoodServicesEligibilityDescriptorId] int NOT NULL ,
[SchoolFoodServicesEligibilityTypeId] int NULL ,
PRIMARY KEY ([SchoolFoodServicesEligibilityDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolFoodServicesEligibilityDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for SchoolFoodServicesEligibilityType
-- ----------------------------

CREATE TABLE [edfi].[SchoolFoodServicesEligibilityType] (
[SchoolFoodServicesEligibilityTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolFoodServicesEligibilityTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolFoodServicesEligibilityType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SchoolFoodServicesEligibilityType_ShortDescription] ON [edfi].[SchoolFoodServicesEligibilityType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SchoolFoodServicesEligibilityType] ON [edfi].[SchoolFoodServicesEligibilityType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SchoolGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[SchoolGradeLevel] (
[SchoolId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for SchoolType
-- ----------------------------

CREATE TABLE [edfi].[SchoolType] (
[SchoolTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SchoolType_ShortDescription] ON [edfi].[SchoolType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SchoolType] ON [edfi].[SchoolType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SchoolYearType
-- ----------------------------

CREATE TABLE [edfi].[SchoolYearType] (
[SchoolYear] smallint NOT NULL ,
[SchoolYearDescription] nvarchar(50) NOT NULL ,
[CurrentSchoolYear] bit NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table SchoolYearType
-- ----------------------------
CREATE UNIQUE INDEX [GUID_SchoolYearType] ON [edfi].[SchoolYearType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_SchoolYearType_CurrentSchoolYear] ON [edfi].[SchoolYearType]
([CurrentSchoolYear] ASC) 
GO
CREATE INDEX [IX_SchoolYearType_Description] ON [edfi].[SchoolYearType]
([SchoolYearDescription] ASC) 
GO

-- ----------------------------
-- Table structure for Section
-- ----------------------------

CREATE TABLE [edfi].[Section] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[UniqueSectionCode] nvarchar(255) NOT NULL ,
[SequenceOfCourse] int NOT NULL ,
[EducationalEnvironmentTypeId] int NULL ,
[MediumOfInstructionTypeId] int NULL ,
[PopulationServedTypeId] int NULL ,
[AvailableCreditTypeId] int NULL ,
[AvailableCreditConversion] decimal(9,2) NULL ,
[InstructionLanguageDescriptorId] int NULL ,
[AvailableCredit] decimal(9,2) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table Section
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Section] ON [edfi].[Section]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_Section_LocalCourseCode] ON [edfi].[Section]
([LocalCourseCode] ASC) 
GO

-- ----------------------------
-- Table structure for SectionAttendanceTakenEvent
-- ----------------------------

CREATE TABLE [edfi].[SectionAttendanceTakenEvent] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[Date] date NOT NULL ,
[EventDate] date NOT NULL ,
[StaffUSI] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [Date])
)


GO

-- ----------------------------
-- Indexes structure for table SectionAttendanceTakenEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_SectionAttendanceTakenEvent] ON [edfi].[SectionAttendanceTakenEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SectionCharacteristic
-- ----------------------------

CREATE TABLE [edfi].[SectionCharacteristic] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[SectionCharacteristicDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [SectionCharacteristicDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table SectionCharacteristic
-- ----------------------------

-- ----------------------------
-- Table structure for SectionCharacteristicDescriptor
-- ----------------------------

CREATE TABLE [edfi].[SectionCharacteristicDescriptor] (
[SectionCharacteristicDescriptorId] int NOT NULL ,
[SectionCharacteristicTypeId] int NULL ,
PRIMARY KEY ([SectionCharacteristicDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table SectionCharacteristicDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for SectionCharacteristicType
-- ----------------------------

CREATE TABLE [edfi].[SectionCharacteristicType] (
[SectionCharacteristicTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SectionCharacteristicTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SectionCharacteristicType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SectionCharacteristicType_ShortDescription] ON [edfi].[SectionCharacteristicType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SectionCharacteristicType] ON [edfi].[SectionCharacteristicType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SectionProgram
-- ----------------------------

CREATE TABLE [edfi].[SectionProgram] (
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [EducationOrganizationId], [ProgramTypeId], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table SectionProgram
-- ----------------------------

-- ----------------------------
-- Table structure for SeparationReasonDescriptor
-- ----------------------------

CREATE TABLE [edfi].[SeparationReasonDescriptor] (
[SeparationReasonDescriptorId] int NOT NULL ,
[SeparationReasonTypeId] int NULL ,
PRIMARY KEY ([SeparationReasonDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table SeparationReasonDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for SeparationReasonType
-- ----------------------------

CREATE TABLE [edfi].[SeparationReasonType] (
[SeparationReasonTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SeparationReasonTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SeparationReasonType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SeparationReasonType_ShortDescription] ON [edfi].[SeparationReasonType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SeparationReasonType] ON [edfi].[SeparationReasonType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SeparationType
-- ----------------------------

CREATE TABLE [edfi].[SeparationType] (
[SeparationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SeparationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SeparationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SeparationType_ShortDescription] ON [edfi].[SeparationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SeparationType] ON [edfi].[SeparationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for ServiceDescriptor
-- ----------------------------

CREATE TABLE [edfi].[ServiceDescriptor] (
[ServiceDescriptorId] int NOT NULL ,
[ServiceCategory] nvarchar(50) NULL ,
PRIMARY KEY ([ServiceDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table ServiceDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for Session
-- ----------------------------

CREATE TABLE [edfi].[Session] (
[SchoolId] int NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[SessionName] nvarchar(60) NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NOT NULL ,
[TotalInstructionalDays] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [TermTypeId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table Session
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Session] ON [edfi].[Session]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SessionAcademicWeek
-- ----------------------------

CREATE TABLE [edfi].[SessionAcademicWeek] (
[SchoolId] int NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[WeekIdentifier] nvarchar(80) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SchoolId], [TermTypeId], [SchoolYear], [EducationOrganizationId], [WeekIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table SessionAcademicWeek
-- ----------------------------

-- ----------------------------
-- Table structure for SessionGradingPeriod
-- ----------------------------

CREATE TABLE [edfi].[SessionGradingPeriod] (
[EducationOrganizationId] int NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[SchoolId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([EducationOrganizationId], [TermTypeId], [SchoolYear], [GradingPeriodDescriptorId], [BeginDate], [SchoolId])
)


GO

-- ----------------------------
-- Indexes structure for table SessionGradingPeriod
-- ----------------------------

-- ----------------------------
-- Table structure for SexType
-- ----------------------------

CREATE TABLE [edfi].[SexType] (
[SexTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SexTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SexType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SexType_ShortDescription] ON [edfi].[SexType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SexType] ON [edfi].[SexType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for SpecialEducationSettingDescriptor
-- ----------------------------

CREATE TABLE [edfi].[SpecialEducationSettingDescriptor] (
[SpecialEducationSettingDescriptorId] int NOT NULL ,
[SpecialEducationSettingTypeId] int NULL ,
PRIMARY KEY ([SpecialEducationSettingDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table SpecialEducationSettingDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for SpecialEducationSettingType
-- ----------------------------

CREATE TABLE [edfi].[SpecialEducationSettingType] (
[SpecialEducationSettingTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([SpecialEducationSettingTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table SpecialEducationSettingType
-- ----------------------------
CREATE UNIQUE INDEX [AK_SpecialEducationSettingType_ShortDescription] ON [edfi].[SpecialEducationSettingType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_SpecialEducationSettingType] ON [edfi].[SpecialEducationSettingType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Staff
-- ----------------------------

CREATE TABLE [edfi].[Staff] (
[StaffUSI] int NOT NULL IDENTITY(1,1) ,
[PersonalTitlePrefix] nvarchar(75) NULL ,
[FirstName] nvarchar(75) NOT NULL ,
[MiddleName] nvarchar(75) NULL ,
[LastSurname] nvarchar(75) NOT NULL ,
[GenerationCodeSuffix] nvarchar(75) NULL ,
[MaidenName] nvarchar(75) NULL ,
[SexTypeId] int NULL ,
[BirthDate] date NULL ,
[HispanicLatinoEthnicity] bit NOT NULL ,
[OldEthnicityTypeId] int NULL ,
[HighestCompletedLevelOfEducationDescriptorId] int NULL ,
[YearsOfPriorProfessionalExperience] int NULL ,
[YearsOfPriorTeachingExperience] int NULL ,
[HighlyQualifiedTeacher] bit NULL ,
[LoginId] nvarchar(60) NULL ,
[CitizenshipStatusTypeId] int NULL ,
[StaffUniqueId] nvarchar(32) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI])
)


GO

-- ----------------------------
-- Indexes structure for table Staff
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Staff] ON [edfi].[Staff]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_Staff_StudentRecord] ON [edfi].[Staff]
([StaffUSI] ASC) 
INCLUDE ([FirstName], [LastSurname]) 
GO
CREATE UNIQUE INDEX [UI_Staff_StaffUniqueId] ON [edfi].[Staff]
([StaffUniqueId] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffAddress
-- ----------------------------

CREATE TABLE [edfi].[StaffAddress] (
[StaffUSI] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[StreetNumberName] nvarchar(150) NOT NULL ,
[ApartmentRoomSuiteNumber] nvarchar(50) NULL ,
[BuildingSiteNumber] nvarchar(20) NULL ,
[City] nvarchar(30) NOT NULL ,
[StateAbbreviationTypeId] int NOT NULL ,
[PostalCode] nvarchar(17) NOT NULL ,
[NameOfCounty] nvarchar(30) NULL ,
[CountyFIPSCode] nvarchar(5) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffAddress
-- ----------------------------

-- ----------------------------
-- Table structure for StaffClassificationDescriptor
-- ----------------------------

CREATE TABLE [edfi].[StaffClassificationDescriptor] (
[StaffClassificationDescriptorId] int NOT NULL ,
[StaffClassificationTypeId] int NULL ,
PRIMARY KEY ([StaffClassificationDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffClassificationDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for StaffClassificationType
-- ----------------------------

CREATE TABLE [edfi].[StaffClassificationType] (
[StaffClassificationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffClassificationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffClassificationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_StaffClassificationType_ShortDescription] ON [edfi].[StaffClassificationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_StaffClassificationType] ON [edfi].[StaffClassificationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffCohortAssociation
-- ----------------------------

CREATE TABLE [edfi].[StaffCohortAssociation] (
[StaffUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CohortIdentifier] nvarchar(20) NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[StudentRecordAccess] bit NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [EducationOrganizationId], [CohortIdentifier], [BeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table StaffCohortAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StaffCohortAssociation] ON [edfi].[StaffCohortAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffCredential
-- ----------------------------

CREATE TABLE [edfi].[StaffCredential] (
[StaffUSI] int NOT NULL ,
[CredentialFieldDescriptorId] int NOT NULL ,
[CredentialTypeId] int NOT NULL ,
[LevelDescriptorId] int NOT NULL ,
[TeachingCredentialDescriptorId] int NOT NULL ,
[CredentialIssuanceDate] date NOT NULL ,
[CredentialExpirationDate] date NULL ,
[TeachingCredentialBasisTypeId] int NULL ,
[StateOfIssueStateAbbreviationTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [CredentialFieldDescriptorId], [CredentialTypeId], [LevelDescriptorId], [TeachingCredentialDescriptorId], [CredentialIssuanceDate])
)


GO

-- ----------------------------
-- Indexes structure for table StaffCredential
-- ----------------------------

-- ----------------------------
-- Table structure for StaffEducationOrganizationAssignmentAssociation
-- ----------------------------

CREATE TABLE [edfi].[StaffEducationOrganizationAssignmentAssociation] (
[StaffUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[StaffClassificationDescriptorId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[PositionTitle] nvarchar(100) NULL ,
[EndDate] date NULL ,
[OrderOfAssignment] int NULL ,
[EmploymentEducationOrganizationId] int NULL ,
[EmploymentStatusDescriptorId] int NULL ,
[EmploymentHireDate] date NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [EducationOrganizationId], [StaffClassificationDescriptorId], [BeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table StaffEducationOrganizationAssignmentAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StaffEducationOrganizationAssignmentAssociation] ON [edfi].[StaffEducationOrganizationAssignmentAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffEducationOrganizationEmploymentAssociation
-- ----------------------------

CREATE TABLE [edfi].[StaffEducationOrganizationEmploymentAssociation] (
[StaffUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[EmploymentStatusDescriptorId] int NOT NULL ,
[HireDate] date NOT NULL ,
[EndDate] date NULL ,
[SeparationTypeId] int NULL ,
[SeparationReasonDescriptorId] int NULL ,
[Department] nvarchar(3) NULL ,
[FullTimeEquivalency] decimal(5,4) NULL ,
[OfferDate] date NULL ,
[HourlyWage] money NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [EducationOrganizationId], [EmploymentStatusDescriptorId], [HireDate])
)


GO

-- ----------------------------
-- Indexes structure for table StaffEducationOrganizationEmploymentAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StaffEducationOrganizationEmploymentAssociation] ON [edfi].[StaffEducationOrganizationEmploymentAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffElectronicMail
-- ----------------------------

CREATE TABLE [edfi].[StaffElectronicMail] (
[StaffUSI] int NOT NULL ,
[ElectronicMailTypeId] int NOT NULL ,
[ElectronicMailAddress] nvarchar(128) NOT NULL ,
[PrimaryEmailAddressIndicator] bit NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [ElectronicMailTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffElectronicMail
-- ----------------------------

-- ----------------------------
-- Table structure for StaffIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[StaffIdentificationCode] (
[StaffUSI] int NOT NULL ,
[StaffIdentificationSystemTypeId] int NOT NULL ,
[AssigningOrganizationIdentificationCode] nvarchar(60) NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [StaffIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for StaffIdentificationDocument
-- ----------------------------

CREATE TABLE [edfi].[StaffIdentificationDocument] (
[PersonalInformationVerificationTypeId] int NOT NULL ,
[IdentificationDocumentUseTypeId] int NOT NULL ,
[StaffUSI] int NOT NULL ,
[DocumentTitle] nvarchar(60) NULL ,
[DocumentExpirationDate] date NULL ,
[IssuerDocumentIdentificationCode] nvarchar(60) NULL ,
[IssuerName] nvarchar(150) NULL ,
[IssuerCountryTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PersonalInformationVerificationTypeId], [IdentificationDocumentUseTypeId], [StaffUSI])
)


GO

-- ----------------------------
-- Indexes structure for table StaffIdentificationDocument
-- ----------------------------

-- ----------------------------
-- Table structure for StaffIdentificationSystemType
-- ----------------------------

CREATE TABLE [edfi].[StaffIdentificationSystemType] (
[StaffIdentificationSystemTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffIdentificationSystemType
-- ----------------------------
CREATE UNIQUE INDEX [AK_StaffIdentificationSystemType_ShortDescription] ON [edfi].[StaffIdentificationSystemType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_StaffIdentificationSystemType] ON [edfi].[StaffIdentificationSystemType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffInternationalAddress
-- ----------------------------

CREATE TABLE [edfi].[StaffInternationalAddress] (
[StaffUSI] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[AddressLine1] nvarchar(150) NOT NULL ,
[AddressLine2] nvarchar(150) NULL ,
[AddressLine3] nvarchar(150) NULL ,
[AddressLine4] nvarchar(150) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CountryTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffInternationalAddress
-- ----------------------------

-- ----------------------------
-- Table structure for StaffLanguage
-- ----------------------------

CREATE TABLE [edfi].[StaffLanguage] (
[StaffUSI] int NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [LanguageDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffLanguage
-- ----------------------------

-- ----------------------------
-- Table structure for StaffLanguageUse
-- ----------------------------

CREATE TABLE [edfi].[StaffLanguageUse] (
[StaffUSI] int NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[LanguageUseTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [LanguageDescriptorId], [LanguageUseTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffLanguageUse
-- ----------------------------

-- ----------------------------
-- Table structure for StaffOtherName
-- ----------------------------

CREATE TABLE [edfi].[StaffOtherName] (
[StaffUSI] int NOT NULL ,
[OtherNameTypeId] int NOT NULL ,
[PersonalTitlePrefix] nvarchar(75) NULL ,
[FirstName] nvarchar(75) NOT NULL ,
[MiddleName] nvarchar(75) NULL ,
[LastSurname] nvarchar(75) NOT NULL ,
[GenerationCodeSuffix] nvarchar(75) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [OtherNameTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffOtherName
-- ----------------------------

-- ----------------------------
-- Table structure for StaffProgramAssociation
-- ----------------------------

CREATE TABLE [edfi].[StaffProgramAssociation] (
[ProgramEducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[StaffUSI] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[StudentRecordAccess] bit NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([ProgramEducationOrganizationId], [ProgramTypeId], [StaffUSI], [BeginDate], [ProgramName])
)


GO

-- ----------------------------
-- Indexes structure for table StaffProgramAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StaffProgramAssociation] ON [edfi].[StaffProgramAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffRace
-- ----------------------------

CREATE TABLE [edfi].[StaffRace] (
[StaffUSI] int NOT NULL ,
[RaceTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [RaceTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffRace
-- ----------------------------

-- ----------------------------
-- Table structure for StaffSchoolAssociation
-- ----------------------------

CREATE TABLE [edfi].[StaffSchoolAssociation] (
[StaffUSI] int NOT NULL ,
[ProgramAssignmentDescriptorId] int NOT NULL ,
[SchoolId] int NOT NULL ,
[SchoolYear] smallint NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffSchoolAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StaffSchoolAssociation] ON [edfi].[StaffSchoolAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StaffSchoolAssociationAcademicSubject
-- ----------------------------

CREATE TABLE [edfi].[StaffSchoolAssociationAcademicSubject] (
[StaffUSI] int NOT NULL ,
[ProgramAssignmentDescriptorId] int NOT NULL ,
[SchoolId] int NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId], [AcademicSubjectDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffSchoolAssociationAcademicSubject
-- ----------------------------

-- ----------------------------
-- Table structure for StaffSchoolAssociationGradeLevel
-- ----------------------------

CREATE TABLE [edfi].[StaffSchoolAssociationGradeLevel] (
[StaffUSI] int NOT NULL ,
[ProgramAssignmentDescriptorId] int NOT NULL ,
[SchoolId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffSchoolAssociationGradeLevel
-- ----------------------------

-- ----------------------------
-- Table structure for StaffSectionAssociation
-- ----------------------------

CREATE TABLE [edfi].[StaffSectionAssociation] (
[StaffUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[ClassroomPositionDescriptorId] int NOT NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[HighlyQualifiedTeacher] bit NULL ,
[TeacherStudentDataLinkExclusion] bit NULL ,
[PercentageContribution] decimal(5,4) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table StaffSectionAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StaffSectionAssociation] ON [edfi].[StaffSectionAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_TeacherSectionAssociation_StudentRecord] ON [edfi].[StaffSectionAssociation]
([ClassroomIdentificationCode] ASC, [SchoolId] ASC, [TermTypeId] ASC, [ClassPeriodName] ASC, [LocalCourseCode] ASC, [StaffUSI] ASC) 
GO

-- ----------------------------
-- Table structure for StaffTelephone
-- ----------------------------

CREATE TABLE [edfi].[StaffTelephone] (
[StaffUSI] int NOT NULL ,
[TelephoneNumberTypeId] int NOT NULL ,
[OrderOfPriority] int NULL ,
[TextMessageCapabilityIndicator] bit NULL ,
[TelephoneNumber] nvarchar(24) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [TelephoneNumberTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffTelephone
-- ----------------------------

-- ----------------------------
-- Table structure for StaffVisa
-- ----------------------------

CREATE TABLE [edfi].[StaffVisa] (
[StaffUSI] int NOT NULL ,
[VisaTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StaffUSI], [VisaTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StaffVisa
-- ----------------------------

-- ----------------------------
-- Table structure for StateAbbreviationType
-- ----------------------------

CREATE TABLE [edfi].[StateAbbreviationType] (
[StateAbbreviationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StateAbbreviationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StateAbbreviationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_StateAbbreviationType_ShortDescription] ON [edfi].[StateAbbreviationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_StateAbbreviationType] ON [edfi].[StateAbbreviationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StateEducationAgency
-- ----------------------------

CREATE TABLE [edfi].[StateEducationAgency] (
[StateEducationAgencyId] int NOT NULL ,
PRIMARY KEY ([StateEducationAgencyId])
)


GO

-- ----------------------------
-- Indexes structure for table StateEducationAgency
-- ----------------------------

-- ----------------------------
-- Table structure for StateEducationAgencyAccountability
-- ----------------------------

CREATE TABLE [edfi].[StateEducationAgencyAccountability] (
[StateEducationAgencyId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[CTEGraduationRateInclusion] bit NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StateEducationAgencyId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table StateEducationAgencyAccountability
-- ----------------------------

-- ----------------------------
-- Table structure for StateEducationAgencyFederalFunds
-- ----------------------------

CREATE TABLE [edfi].[StateEducationAgencyFederalFunds] (
[StateEducationAgencyId] int NOT NULL ,
[FiscalYear] int NOT NULL ,
[FederalProgramsFundingAllocation] money NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StateEducationAgencyId], [FiscalYear])
)


GO

-- ----------------------------
-- Indexes structure for table StateEducationAgencyFederalFunds
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StateEducationAgencyFederalFunds] ON [edfi].[StateEducationAgencyFederalFunds]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for Student
-- ----------------------------

CREATE TABLE [edfi].[Student] (
[StudentUSI] int NOT NULL IDENTITY(1,1) ,
[PersonalTitlePrefix] nvarchar(75) NULL ,
[FirstName] nvarchar(75) NOT NULL ,
[MiddleName] nvarchar(75) NULL ,
[LastSurname] nvarchar(75) NOT NULL ,
[GenerationCodeSuffix] nvarchar(75) NULL ,
[MaidenName] nvarchar(75) NULL ,
[SexTypeId] int NOT NULL ,
[BirthDate] date NOT NULL ,
[CityOfBirth] nvarchar(30) NULL ,
[BirthStateAbbreviationTypeId] int NULL ,
[BirthCountryCodeTypeId] int NULL ,
[DateEnteredUS] date NULL ,
[MultipleBirthStatus] bit NULL ,
[ProfileThumbnail] nvarchar(59) NULL ,
[HispanicLatinoEthnicity] bit NOT NULL ,
[OldEthnicityTypeId] int NULL ,
[EconomicDisadvantaged] bit NULL ,
[SchoolFoodServicesEligibilityDescriptorId] int NULL ,
[LimitedEnglishProficiencyDescriptorId] int NULL ,
[DisplacementStatus] nvarchar(30) NULL ,
[LoginId] nvarchar(60) NULL ,
[InternationalProvinceOfBirth] nvarchar(150) NULL ,
[CitizenshipStatusTypeId] int NULL ,
[StudentUniqueId] nvarchar(32) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI])
)


GO

-- ----------------------------
-- Indexes structure for table Student
-- ----------------------------
CREATE UNIQUE INDEX [GUID_Student] ON [edfi].[Student]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [UI_Student_StudentUniqueId] ON [edfi].[Student]
([StudentUniqueId] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentAcademicRecord
-- ----------------------------

CREATE TABLE [edfi].[StudentAcademicRecord] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[CumulativeEarnedCreditTypeId] int NULL ,
[CumulativeEarnedCreditConversion] decimal(9,2) NULL ,
[CumulativeEarnedCredit] decimal(9,2) NULL ,
[CumulativeAttemptedCreditTypeId] int NULL ,
[CumulativeAttemptedCreditConversion] decimal(9,2) NULL ,
[CumulativeAttemptedCredit] decimal(9,2) NULL ,
[CumulativeGradePointsEarned] decimal(18,4) NULL ,
[CumulativeGradePointAverage] decimal(18,4) NULL ,
[GradeValueQualifier] nvarchar(80) NULL ,
[ProjectedGraduationDate] date NULL ,
[SessionEarnedCreditTypeId] int NULL ,
[SessionEarnedCreditConversion] decimal(9,2) NULL ,
[SessionEarnedCredit] decimal(9,2) NULL ,
[SessionAttemptedCreditTypeId] int NULL ,
[SessionAttemptedCreditConversion] decimal(9,2) NULL ,
[SessionAttemptedCredit] decimal(9,2) NULL ,
[SessionGradePointsEarned] decimal(18,4) NULL ,
[SessionGradePointAverage] decimal(18,4) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAcademicRecord
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentAcademicRecord] ON [edfi].[StudentAcademicRecord]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentAcademicRecordAcademicHonor
-- ----------------------------

CREATE TABLE [edfi].[StudentAcademicRecordAcademicHonor] (
[AcademicHonorCategoryTypeId] int NOT NULL ,
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[HonorDescription] nvarchar(80) NULL ,
[HonorAwardDate] date NULL ,
[HonorAwardExpiresDate] date NULL ,
[AchievementTitle] nvarchar(60) NULL ,
[AchievementCategoryDescriptorId] int NOT NULL ,
[AchievementCategorySystem] nvarchar(60) NULL ,
[IssuerName] nvarchar(150) NULL ,
[IssuerOriginURL] nvarchar(255) NULL ,
[Criteria] nvarchar(150) NULL ,
[CriteriaURL] nvarchar(255) NULL ,
[EvidenceStatement] nvarchar(150) NULL ,
[ImageURL] nvarchar(255) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([AcademicHonorCategoryTypeId], [StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAcademicRecordAcademicHonor
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAcademicRecordClassRanking
-- ----------------------------

CREATE TABLE [edfi].[StudentAcademicRecordClassRanking] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[ClassRank] int NOT NULL ,
[TotalNumberInClass] int NOT NULL ,
[PercentageRanking] int NULL ,
[ClassRankingDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAcademicRecordClassRanking
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAcademicRecordDiploma
-- ----------------------------

CREATE TABLE [edfi].[StudentAcademicRecordDiploma] (
[StudentUSI] int NOT NULL ,
[DiplomaTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[DiplomaAwardDate] date NOT NULL ,
[DiplomaLevelTypeId] int NULL ,
[TermTypeId] int NOT NULL ,
[CTECompleter] bit NULL ,
[DiplomaDescription] nvarchar(80) NULL ,
[DiplomaAwardExpiresDate] date NULL ,
[AchievementTitle] nvarchar(60) NULL ,
[AchievementCategoryDescriptorId] int NOT NULL ,
[AchievementCategorySystem] nvarchar(60) NULL ,
[IssuerName] nvarchar(150) NULL ,
[IssuerOriginURL] nvarchar(255) NULL ,
[Criteria] nvarchar(150) NULL ,
[CriteriaURL] nvarchar(255) NULL ,
[EvidenceStatement] nvarchar(150) NULL ,
[ImageURL] nvarchar(255) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [DiplomaTypeId], [SchoolYear], [EducationOrganizationId], [DiplomaAwardDate], [TermTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAcademicRecordDiploma
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAcademicRecordRecognition
-- ----------------------------

CREATE TABLE [edfi].[StudentAcademicRecordRecognition] (
[RecognitionTypeId] int NOT NULL ,
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[RecognitionDescription] nvarchar(80) NULL ,
[RecognitionAwardDate] date NULL ,
[RecognitionAwardExpiresDate] date NULL ,
[AchievementTitle] nvarchar(60) NULL ,
[AchievementCategoryDescriptorId] int NOT NULL ,
[AchievementCategorySystem] nvarchar(60) NULL ,
[IssuerName] nvarchar(150) NULL ,
[IssuerOriginURL] nvarchar(255) NULL ,
[Criteria] nvarchar(150) NULL ,
[CriteriaURL] nvarchar(255) NULL ,
[EvidenceStatement] nvarchar(150) NULL ,
[ImageURL] nvarchar(255) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([RecognitionTypeId], [StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAcademicRecordRecognition
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAcademicRecordReportCard
-- ----------------------------

CREATE TABLE [edfi].[StudentAcademicRecordReportCard] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[TermTypeId] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAcademicRecordReportCard
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAddress
-- ----------------------------

CREATE TABLE [edfi].[StudentAddress] (
[StudentUSI] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[StreetNumberName] nvarchar(150) NOT NULL ,
[ApartmentRoomSuiteNumber] nvarchar(50) NULL ,
[BuildingSiteNumber] nvarchar(20) NULL ,
[City] nvarchar(30) NOT NULL ,
[StateAbbreviationTypeId] int NOT NULL ,
[PostalCode] nvarchar(17) NOT NULL ,
[NameOfCounty] nvarchar(30) NULL ,
[CountyFIPSCode] nvarchar(5) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAddress
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAssessment
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessment] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AdministrationDate] date NOT NULL ,
[AdministrationEndDate] date NULL ,
[SerialNumber] nvarchar(60) NULL ,
[AdministrationLanguageDescriptorId] int NULL ,
[AdministrationEnvironmentTypeId] int NULL ,
[RetestIndicatorTypeId] int NULL ,
[ReasonNotTestedTypeId] int NULL ,
[WhenAssessedGradeLevelDescriptorId] int NULL ,
[EventCircumstanceTypeId] int NULL ,
[EventDescription] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessment
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentAssessment] ON [edfi].[StudentAssessment]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_StudentAssessment_StudentRecord] ON [edfi].[StudentAssessment]
([AssessmentTitle] ASC, [Version] ASC, [AcademicSubjectDescriptorId] ASC, [AssessedGradeLevelDescriptorId] ASC, [StudentUSI] ASC, [AdministrationDate] ASC) 
INCLUDE ([AdministrationLanguageDescriptorId]) 
GO

-- ----------------------------
-- Table structure for StudentAssessmentAccommodation
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentAccommodation] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AdministrationDate] date NOT NULL ,
[AccommodationDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate], [AccommodationDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentAccommodation
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAssessmentItem
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentItem] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[AdministrationDate] date NOT NULL ,
[AssessmentResponse] nvarchar(60) NULL ,
[ResponseIndicatorTypeId] int NULL ,
[AssessmentItemResultTypeId] int NOT NULL ,
[RawScoreResult] int NULL ,
[TimeAssessed] nvarchar(30) NULL ,
[DescriptiveFeedback] nvarchar(1024) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentItem
-- ----------------------------
CREATE INDEX [IX_AssessmentItem_SubjType] ON [edfi].[StudentAssessmentItem]
([AssessmentTitle] ASC, [AcademicSubjectDescriptorId] ASC) 
GO

-- ----------------------------
-- Table structure for StudentAssessmentPerformanceLevel
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentPerformanceLevel] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AdministrationDate] date NOT NULL ,
[PerformanceLevelDescriptorId] int NOT NULL ,
[PerformanceLevelMet] bit NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate], [PerformanceLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentPerformanceLevel
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAssessmentScoreResult
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentScoreResult] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[AdministrationDate] date NOT NULL ,
[AssessmentReportingMethodTypeId] int NOT NULL ,
[Result] nvarchar(35) NOT NULL ,
[ResultDatatypeTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate], [AssessmentReportingMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentScoreResult
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAssessmentStudentObjectiveAssessment
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentStudentObjectiveAssessment] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[AdministrationDate] date NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentStudentObjectiveAssessment
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAssessmentStudentObjectiveAssessmentPerformanceLevel
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentPerformanceLevel] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[AdministrationDate] date NOT NULL ,
[PerformanceLevelDescriptorId] int NOT NULL ,
[PerformanceLevelMet] bit NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate], [PerformanceLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentStudentObjectiveAssessmentPerformanceLevel
-- ----------------------------

-- ----------------------------
-- Table structure for StudentAssessmentStudentObjectiveAssessmentScoreResult
-- ----------------------------

CREATE TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentScoreResult] (
[StudentUSI] int NOT NULL ,
[AssessmentTitle] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[AssessedGradeLevelDescriptorId] int NOT NULL ,
[Version] int NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[AdministrationDate] date NOT NULL ,
[AssessmentReportingMethodTypeId] int NOT NULL ,
[Result] nvarchar(35) NOT NULL ,
[ResultDatatypeTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate], [AssessmentReportingMethodTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentAssessmentStudentObjectiveAssessmentScoreResult
-- ----------------------------

-- ----------------------------
-- Table structure for StudentCharacteristic
-- ----------------------------

CREATE TABLE [edfi].[StudentCharacteristic] (
[StudentUSI] int NOT NULL ,
[StudentCharacteristicDescriptorId] int NOT NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[DesignatedBy] nvarchar(60) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [StudentCharacteristicDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCharacteristic
-- ----------------------------

-- ----------------------------
-- Table structure for StudentCharacteristicDescriptor
-- ----------------------------

CREATE TABLE [edfi].[StudentCharacteristicDescriptor] (
[StudentCharacteristicDescriptorId] int NOT NULL ,
[StudentCharacteristicTypeId] int NULL ,
PRIMARY KEY ([StudentCharacteristicDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCharacteristicDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for StudentCharacteristicType
-- ----------------------------

CREATE TABLE [edfi].[StudentCharacteristicType] (
[StudentCharacteristicTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentCharacteristicTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCharacteristicType
-- ----------------------------
CREATE UNIQUE INDEX [AK_StudentCharacteristicType_ShortDescription] ON [edfi].[StudentCharacteristicType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_StudentCharacteristicType] ON [edfi].[StudentCharacteristicType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentCohortAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentCohortAssociation] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CohortIdentifier] nvarchar(20) NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [CohortIdentifier], [BeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCohortAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentCohortAssociation] ON [edfi].[StudentCohortAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentCohortAssociationSection
-- ----------------------------

CREATE TABLE [edfi].[StudentCohortAssociationSection] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CohortIdentifier] nvarchar(20) NOT NULL ,
[BeginDate] date NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [CohortIdentifier], [BeginDate], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCohortAssociationSection
-- ----------------------------

-- ----------------------------
-- Table structure for StudentCohortYear
-- ----------------------------

CREATE TABLE [edfi].[StudentCohortYear] (
[StudentUSI] int NOT NULL ,
[CohortYearTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [CohortYearTypeId], [SchoolYear])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCohortYear
-- ----------------------------

-- ----------------------------
-- Table structure for StudentCompetencyObjective
-- ----------------------------

CREATE TABLE [edfi].[StudentCompetencyObjective] (
[StudentUSI] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[ObjectiveEducationOrganizationId] int NOT NULL ,
[CompetencyLevelDescriptorId] int NOT NULL ,
[DiagnosticStatement] nvarchar(1024) NULL ,
[SchoolId] int NULL ,
[ClassPeriodName] nvarchar(20) NULL ,
[ClassroomIdentificationCode] nvarchar(20) NULL ,
[LocalCourseCode] nvarchar(60) NULL ,
[TermTypeId] int NULL ,
[SchoolYear] smallint NULL ,
[BeginDate] date NULL ,
[ProgramEducationOrganizationId] int NULL ,
[ProgramTypeId] int NULL ,
[ProgramName] nvarchar(60) NULL ,
[EducationOrganizationId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [ObjectiveGradeLevelDescriptorId], [ObjectiveEducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCompetencyObjective
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentCompetencyObjective] ON [edfi].[StudentCompetencyObjective]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentCTEProgramAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentCTEProgramAssociation] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCTEProgramAssociation
-- ----------------------------

-- ----------------------------
-- Table structure for StudentCTEProgramAssociationCTEProgram
-- ----------------------------

CREATE TABLE [edfi].[StudentCTEProgramAssociationCTEProgram] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[CareerPathwayTypeId] int NOT NULL ,
[CIPCode] nvarchar(120) NULL ,
[PrimaryCTEProgramIndicator] bit NULL ,
[CTEProgramCompletionIndicator] bit NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramEducationOrganizationId], [BeginDate], [CareerPathwayTypeId], [ProgramName], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentCTEProgramAssociationCTEProgram
-- ----------------------------

-- ----------------------------
-- Table structure for StudentDisability
-- ----------------------------

CREATE TABLE [edfi].[StudentDisability] (
[StudentUSI] int NOT NULL ,
[DisabilityDiagnosis] nvarchar(80) NULL ,
[OrderOfDisability] int NULL ,
[DisabilityDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [DisabilityDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentDisability
-- ----------------------------

-- ----------------------------
-- Table structure for StudentDisciplineIncidentAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentDisciplineIncidentAssociation] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[IncidentIdentifier] nvarchar(20) NOT NULL ,
[StudentParticipationCodeTypeId] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [IncidentIdentifier])
)


GO

-- ----------------------------
-- Indexes structure for table StudentDisciplineIncidentAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentDisciplineIncidentAssociation] ON [edfi].[StudentDisciplineIncidentAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentDisciplineIncidentAssociationBehavior
-- ----------------------------

CREATE TABLE [edfi].[StudentDisciplineIncidentAssociationBehavior] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[IncidentIdentifier] nvarchar(20) NOT NULL ,
[BehaviorDescriptorId] int NOT NULL ,
[BehaviorDetailedDescription] nvarchar(1024) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [IncidentIdentifier], [BehaviorDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentDisciplineIncidentAssociationBehavior
-- ----------------------------

-- ----------------------------
-- Table structure for StudentEducationOrganizationAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentEducationOrganizationAssociation] (
[StudentUSI] int NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[ResponsibilityDescriptorId] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [EducationOrganizationId], [ResponsibilityDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentEducationOrganizationAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentEducationOrganizationAssociation] ON [edfi].[StudentEducationOrganizationAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentElectronicMail
-- ----------------------------

CREATE TABLE [edfi].[StudentElectronicMail] (
[StudentUSI] int NOT NULL ,
[ElectronicMailTypeId] int NOT NULL ,
[ElectronicMailAddress] nvarchar(128) NOT NULL ,
[PrimaryEmailAddressIndicator] bit NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ElectronicMailTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentElectronicMail
-- ----------------------------

-- ----------------------------
-- Table structure for StudentGradebookEntry
-- ----------------------------

CREATE TABLE [edfi].[StudentGradebookEntry] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[BeginDate] date NOT NULL ,
[GradebookEntryTitle] nvarchar(60) NOT NULL ,
[DateAssigned] date NOT NULL ,
[DateFulfilled] date NULL ,
[LetterGradeEarned] nvarchar(20) NULL ,
[NumericGradeEarned] int NULL ,
[CompetencyLevelDescriptorId] int NULL ,
[DiagnosticStatement] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate], [GradebookEntryTitle], [DateAssigned])
)


GO

-- ----------------------------
-- Indexes structure for table StudentGradebookEntry
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentGradebookEntry] ON [edfi].[StudentGradebookEntry]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentIdentificationCode
-- ----------------------------

CREATE TABLE [edfi].[StudentIdentificationCode] (
[StudentUSI] int NOT NULL ,
[StudentIdentificationSystemTypeId] int NOT NULL ,
[AssigningOrganizationIdentificationCode] nvarchar(60) NOT NULL ,
[IdentificationCode] nvarchar(60) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [StudentIdentificationSystemTypeId], [AssigningOrganizationIdentificationCode])
)


GO

-- ----------------------------
-- Indexes structure for table StudentIdentificationCode
-- ----------------------------

-- ----------------------------
-- Table structure for StudentIdentificationDocument
-- ----------------------------

CREATE TABLE [edfi].[StudentIdentificationDocument] (
[PersonalInformationVerificationTypeId] int NOT NULL ,
[IdentificationDocumentUseTypeId] int NOT NULL ,
[StudentUSI] int NOT NULL ,
[DocumentTitle] nvarchar(60) NULL ,
[DocumentExpirationDate] date NULL ,
[IssuerDocumentIdentificationCode] nvarchar(60) NULL ,
[IssuerName] nvarchar(150) NULL ,
[IssuerCountryTypeId] int NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([PersonalInformationVerificationTypeId], [IdentificationDocumentUseTypeId], [StudentUSI])
)


GO

-- ----------------------------
-- Indexes structure for table StudentIdentificationDocument
-- ----------------------------

-- ----------------------------
-- Table structure for StudentIdentificationSystemType
-- ----------------------------

CREATE TABLE [edfi].[StudentIdentificationSystemType] (
[StudentIdentificationSystemTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentIdentificationSystemTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentIdentificationSystemType
-- ----------------------------
CREATE UNIQUE INDEX [AK_StudentIdentificationSystemType_ShortDescription] ON [edfi].[StudentIdentificationSystemType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_StudentIdentificationSystemType] ON [edfi].[StudentIdentificationSystemType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentIndicator
-- ----------------------------

CREATE TABLE [edfi].[StudentIndicator] (
[StudentUSI] int NOT NULL ,
[IndicatorName] nvarchar(60) NOT NULL ,
[Indicator] nvarchar(35) NOT NULL ,
[IndicatorGroup] nvarchar(60) NULL ,
[BeginDate] datetime NULL ,
[EndDate] datetime NULL ,
[DesignatedBy] nvarchar(60) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [IndicatorName])
)


GO

-- ----------------------------
-- Indexes structure for table StudentIndicator
-- ----------------------------

-- ----------------------------
-- Table structure for StudentInternationalAddress
-- ----------------------------

CREATE TABLE [edfi].[StudentInternationalAddress] (
[StudentUSI] int NOT NULL ,
[AddressTypeId] int NOT NULL ,
[AddressLine1] nvarchar(150) NOT NULL ,
[AddressLine2] nvarchar(150) NULL ,
[AddressLine3] nvarchar(150) NULL ,
[AddressLine4] nvarchar(150) NULL ,
[Latitude] nvarchar(20) NULL ,
[Longitude] nvarchar(20) NULL ,
[BeginDate] date NULL ,
[EndDate] date NULL ,
[CountryTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [AddressTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentInternationalAddress
-- ----------------------------

-- ----------------------------
-- Table structure for StudentInterventionAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentInterventionAssociation] (
[StudentUSI] int NOT NULL ,
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CohortEducationOrganizationId] int NULL ,
[CohortIdentifier] nvarchar(20) NULL ,
[DiagnosticStatement] nvarchar(1024) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [InterventionIdentificationCode], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentInterventionAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentInterventionAssociation] ON [edfi].[StudentInterventionAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentInterventionAssociationInterventionEffectiveness
-- ----------------------------

CREATE TABLE [edfi].[StudentInterventionAssociationInterventionEffectiveness] (
[StudentUSI] int NOT NULL ,
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[DiagnosisDescriptorId] int NOT NULL ,
[PopulationServedTypeId] int NOT NULL ,
[GradeLevelDescriptorId] int NOT NULL ,
[ImprovementIndex] int NULL ,
[InterventionEffectivenessRatingTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [InterventionIdentificationCode], [EducationOrganizationId], [DiagnosisDescriptorId], [PopulationServedTypeId], [GradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentInterventionAssociationInterventionEffectiveness
-- ----------------------------

-- ----------------------------
-- Table structure for StudentInterventionAttendanceEvent
-- ----------------------------

CREATE TABLE [edfi].[StudentInterventionAttendanceEvent] (
[StudentUSI] int NOT NULL ,
[InterventionIdentificationCode] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[EventDate] date NOT NULL ,
[AttendanceEventReason] nvarchar(40) NULL ,
[EducationalEnvironmentTypeId] int NULL ,
[AttendanceEventCategoryDescriptorId] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [InterventionIdentificationCode], [EducationOrganizationId], [EventDate], [AttendanceEventCategoryDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentInterventionAttendanceEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentInterventionAttendanceEvent] ON [edfi].[StudentInterventionAttendanceEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_StudentInterventionAttendanceEvent_EventDate] ON [edfi].[StudentInterventionAttendanceEvent]
([EventDate] ASC) 
GO

-- ----------------------------
-- Table structure for StudentLanguage
-- ----------------------------

CREATE TABLE [edfi].[StudentLanguage] (
[StudentUSI] int NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [LanguageDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentLanguage
-- ----------------------------

-- ----------------------------
-- Table structure for StudentLanguageUse
-- ----------------------------

CREATE TABLE [edfi].[StudentLanguageUse] (
[StudentUSI] int NOT NULL ,
[LanguageDescriptorId] int NOT NULL ,
[LanguageUseTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [LanguageDescriptorId], [LanguageUseTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentLanguageUse
-- ----------------------------

-- ----------------------------
-- Table structure for StudentLearningObjective
-- ----------------------------

CREATE TABLE [edfi].[StudentLearningObjective] (
[StudentUSI] int NOT NULL ,
[GradingPeriodEducationOrganizationId] int NOT NULL ,
[GradingPeriodDescriptorId] int NOT NULL ,
[GradingPeriodBeginDate] date NOT NULL ,
[Objective] nvarchar(60) NOT NULL ,
[AcademicSubjectDescriptorId] int NOT NULL ,
[ObjectiveGradeLevelDescriptorId] int NOT NULL ,
[CompetencyLevelDescriptorId] int NOT NULL ,
[DiagnosticStatement] nvarchar(1024) NULL ,
[SchoolId] int NULL ,
[ClassPeriodName] nvarchar(20) NULL ,
[ClassroomIdentificationCode] nvarchar(20) NULL ,
[LocalCourseCode] nvarchar(60) NULL ,
[TermTypeId] int NULL ,
[SchoolYear] smallint NULL ,
[BeginDate] date NULL ,
[ProgramEducationOrganizationId] int NULL ,
[ProgramTypeId] int NULL ,
[ProgramName] nvarchar(60) NULL ,
[EducationOrganizationId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentLearningObjective
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentLearningObjective] ON [edfi].[StudentLearningObjective]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentLearningStyle
-- ----------------------------

CREATE TABLE [edfi].[StudentLearningStyle] (
[StudentUSI] int NOT NULL ,
[VisualLearning] decimal(9,4) NOT NULL ,
[AuditoryLearning] decimal(9,4) NOT NULL ,
[TactileLearning] decimal(9,4) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI])
)


GO

-- ----------------------------
-- Indexes structure for table StudentLearningStyle
-- ----------------------------

-- ----------------------------
-- Table structure for StudentMigrantEducationProgramAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentMigrantEducationProgramAssociation] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[PriorityForServices] bit NOT NULL ,
[LastQualifyingMove] date NOT NULL ,
[ContinuationOfServicesReasonDescriptorId] int NULL ,
[USInitialEntry] date NULL ,
[USMostRecentEntry] date NULL ,
[USInitialSchoolEntry] date NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentMigrantEducationProgramAssociation
-- ----------------------------

-- ----------------------------
-- Table structure for StudentOtherName
-- ----------------------------

CREATE TABLE [edfi].[StudentOtherName] (
[StudentUSI] int NOT NULL ,
[OtherNameTypeId] int NOT NULL ,
[PersonalTitlePrefix] nvarchar(75) NULL ,
[FirstName] nvarchar(75) NOT NULL ,
[MiddleName] nvarchar(75) NULL ,
[LastSurname] nvarchar(75) NOT NULL ,
[GenerationCodeSuffix] nvarchar(75) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [OtherNameTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentOtherName
-- ----------------------------

-- ----------------------------
-- Table structure for StudentParentAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentParentAssociation] (
[StudentUSI] int NOT NULL ,
[ParentUSI] int NOT NULL ,
[RelationTypeId] int NULL ,
[PrimaryContactStatus] bit NULL ,
[LivesWith] bit NULL ,
[EmergencyContactStatus] bit NULL ,
[ContactPriority] int NULL ,
[ContactRestrictions] nvarchar(250) NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ParentUSI])
)


GO

-- ----------------------------
-- Indexes structure for table StudentParentAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentParentAssociation] ON [edfi].[StudentParentAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentParticipationCodeType
-- ----------------------------

CREATE TABLE [edfi].[StudentParticipationCodeType] (
[StudentParticipationCodeTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentParticipationCodeTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentParticipationCodeType
-- ----------------------------
CREATE UNIQUE INDEX [AK_StudentParticipationCodeType_ShortDescription] ON [edfi].[StudentParticipationCodeType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_StudentParticipationCodeType] ON [edfi].[StudentParticipationCodeType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentProgramAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentProgramAssociation] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[ReasonExitedDescriptorId] int NULL ,
[ServedOutsideOfRegularSession] bit NULL ,
[EducationOrganizationId] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentProgramAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentProgramAssociation] ON [edfi].[StudentProgramAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentProgramAssociationService
-- ----------------------------

CREATE TABLE [edfi].[StudentProgramAssociationService] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[ServiceDescriptorId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[PrimaryIndicator] bit NULL ,
[ServiceBeginDate] date NULL ,
[ServiceEndDate] date NULL ,
[EducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramEducationOrganizationId], [BeginDate], [ServiceDescriptorId], [ProgramName], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentProgramAssociationService
-- ----------------------------

-- ----------------------------
-- Table structure for StudentProgramAttendanceEvent
-- ----------------------------

CREATE TABLE [edfi].[StudentProgramAttendanceEvent] (
[StudentUSI] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[EventDate] date NOT NULL ,
[AttendanceEventReason] nvarchar(40) NULL ,
[AttendanceEventCategoryDescriptorId] int NOT NULL ,
[EducationalEnvironmentTypeId] int NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [EventDate], [AttendanceEventCategoryDescriptorId], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentProgramAttendanceEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentProgramAttendanceEvent] ON [edfi].[StudentProgramAttendanceEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for StudentProgramParticipation
-- ----------------------------

CREATE TABLE [edfi].[StudentProgramParticipation] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[BeginDate] datetime NULL ,
[EndDate] datetime NULL ,
[DesignatedBy] nvarchar(60) NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentProgramParticipation
-- ----------------------------

-- ----------------------------
-- Table structure for StudentProgramParticipationProgramCharacteristic
-- ----------------------------

CREATE TABLE [edfi].[StudentProgramParticipationProgramCharacteristic] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramCharacteristicDescriptorId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramCharacteristicDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentProgramParticipationProgramCharacteristic
-- ----------------------------

-- ----------------------------
-- Table structure for StudentRace
-- ----------------------------

CREATE TABLE [edfi].[StudentRace] (
[StudentUSI] int NOT NULL ,
[RaceTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [RaceTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentRace
-- ----------------------------

-- ----------------------------
-- Table structure for StudentSchoolAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentSchoolAssociation] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[SchoolYear] smallint NULL ,
[EntryDate] date NOT NULL ,
[EntryGradeLevelDescriptorId] int NOT NULL ,
[EntryGradeLevelReasonTypeId] int NULL ,
[EntryTypeDescriptorId] int NULL ,
[RepeatGradeIndicator] bit NULL ,
[SchoolChoiceTransfer] bit NULL ,
[ExitWithdrawDate] date NULL ,
[ExitWithdrawTypeDescriptorId] int NULL ,
[ResidencyStatusDescriptorId] int NULL ,
[PrimarySchool] bit NULL ,
[EmployedWhileEnrolled] bit NULL ,
[ClassOfSchoolYear] smallint NULL ,
[EducationOrganizationId] int NULL ,
[GraduationPlanTypeDescriptorId] int NULL ,
[GraduationSchoolYear] smallint NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [EntryDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSchoolAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentSchoolAssociation] ON [edfi].[StudentSchoolAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_StudentSchoolAssociation_ExitWithdrawDateStudentUSI] ON [edfi].[StudentSchoolAssociation]
([ExitWithdrawDate] ASC, [StudentUSI] ASC) 
GO
CREATE INDEX [IX_StudentSchoolAssociation_StudentUSI] ON [edfi].[StudentSchoolAssociation]
([StudentUSI] ASC) 
GO

-- ----------------------------
-- Table structure for StudentSchoolAssociationEducationPlan
-- ----------------------------

CREATE TABLE [edfi].[StudentSchoolAssociationEducationPlan] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[EntryDate] date NOT NULL ,
[EducationPlanTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [EntryDate], [EducationPlanTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSchoolAssociationEducationPlan
-- ----------------------------

-- ----------------------------
-- Table structure for StudentSchoolAttendanceEvent
-- ----------------------------

CREATE TABLE [edfi].[StudentSchoolAttendanceEvent] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[EventDate] date NOT NULL ,
[AttendanceEventCategoryDescriptorId] int NOT NULL ,
[AttendanceEventReason] nvarchar(40) NULL ,
[EducationalEnvironmentTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [TermTypeId], [SchoolYear], [EventDate], [AttendanceEventCategoryDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSchoolAttendanceEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentSchoolAttendanceEvent] ON [edfi].[StudentSchoolAttendanceEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_StudentSchoolAttendanceEvent_EventDate] ON [edfi].[StudentSchoolAttendanceEvent]
([EventDate] ASC) 
GO

-- ----------------------------
-- Table structure for StudentSectionAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentSectionAssociation] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[BeginDate] date NOT NULL ,
[EndDate] date NULL ,
[HomeroomIndicator] bit NULL ,
[RepeatIdentifierTypeId] int NULL ,
[TeacherStudentDataLinkExclusion] bit NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSectionAssociation
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentSectionAssociation] ON [edfi].[StudentSectionAssociation]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_StudentSectionAssociation_BDates] ON [edfi].[StudentSectionAssociation]
([BeginDate] ASC, [EndDate] ASC) 
GO
CREATE INDEX [IX_StudentSectionAssociation_EDates] ON [edfi].[StudentSectionAssociation]
([EndDate] ASC, [BeginDate] ASC) 
GO

-- ----------------------------
-- Table structure for StudentSectionAttendanceEvent
-- ----------------------------

CREATE TABLE [edfi].[StudentSectionAttendanceEvent] (
[StudentUSI] int NOT NULL ,
[SchoolId] int NOT NULL ,
[ClassPeriodName] nvarchar(20) NOT NULL ,
[ClassroomIdentificationCode] nvarchar(20) NOT NULL ,
[LocalCourseCode] nvarchar(60) NOT NULL ,
[TermTypeId] int NOT NULL ,
[SchoolYear] smallint NOT NULL ,
[EventDate] date NOT NULL ,
[AttendanceEventCategoryDescriptorId] int NOT NULL ,
[AttendanceEventReason] nvarchar(40) NULL ,
[EducationalEnvironmentTypeId] int NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [EventDate], [AttendanceEventCategoryDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSectionAttendanceEvent
-- ----------------------------
CREATE UNIQUE INDEX [GUID_StudentSectionAttendanceEvent] ON [edfi].[StudentSectionAttendanceEvent]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE INDEX [IX_StudentSectionAttendanceEvent] ON [edfi].[StudentSectionAttendanceEvent]
([SchoolId] ASC, [EventDate] DESC) 
GO
CREATE INDEX [IX_StudentSectionAttendanceEvent_EventDate] ON [edfi].[StudentSectionAttendanceEvent]
([EventDate] ASC) 
GO

-- ----------------------------
-- Table structure for StudentSpecialEducationProgramAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentSpecialEducationProgramAssociation] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[IdeaEligibility] bit NULL ,
[SpecialEducationSettingDescriptorId] int NOT NULL ,
[SpecialEducationHoursPerWeek] decimal(5,2) NULL ,
[SchoolHoursPerWeek] decimal(5,2) NULL ,
[MultiplyDisabled] bit NULL ,
[MedicallyFragile] bit NULL ,
[LastEvaluationDate] date NULL ,
[IEPReviewDate] date NULL ,
[IEPBeginDate] date NULL ,
[IEPEndDate] date NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSpecialEducationProgramAssociation
-- ----------------------------

-- ----------------------------
-- Table structure for StudentSpecialEducationProgramAssociationServiceProvider
-- ----------------------------

CREATE TABLE [edfi].[StudentSpecialEducationProgramAssociationServiceProvider] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[StaffUSI] int NOT NULL ,
[PrimaryProvider] bit NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramEducationOrganizationId], [BeginDate], [StaffUSI], [ProgramName], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentSpecialEducationProgramAssociationServiceProvider
-- ----------------------------

-- ----------------------------
-- Table structure for StudentTelephone
-- ----------------------------

CREATE TABLE [edfi].[StudentTelephone] (
[StudentUSI] int NOT NULL ,
[TelephoneNumberTypeId] int NOT NULL ,
[OrderOfPriority] int NULL ,
[TextMessageCapabilityIndicator] bit NULL ,
[TelephoneNumber] nvarchar(24) NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [TelephoneNumberTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentTelephone
-- ----------------------------

-- ----------------------------
-- Table structure for StudentTitleIPartAProgramAssociation
-- ----------------------------

CREATE TABLE [edfi].[StudentTitleIPartAProgramAssociation] (
[StudentUSI] int NOT NULL ,
[ProgramTypeId] int NOT NULL ,
[ProgramEducationOrganizationId] int NOT NULL ,
[BeginDate] date NOT NULL ,
[TitleIPartAParticipantTypeId] int NOT NULL ,
[ProgramName] nvarchar(60) NOT NULL ,
[EducationOrganizationId] int NOT NULL ,
PRIMARY KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentTitleIPartAProgramAssociation
-- ----------------------------

-- ----------------------------
-- Table structure for StudentVisa
-- ----------------------------

CREATE TABLE [edfi].[StudentVisa] (
[StudentUSI] int NOT NULL ,
[VisaTypeId] int NOT NULL ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([StudentUSI], [VisaTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table StudentVisa
-- ----------------------------

-- ----------------------------
-- Table structure for TeachingCredentialBasisType
-- ----------------------------

CREATE TABLE [edfi].[TeachingCredentialBasisType] (
[TeachingCredentialBasisTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([TeachingCredentialBasisTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table TeachingCredentialBasisType
-- ----------------------------
CREATE UNIQUE INDEX [AK_TeachingCredentialBasisType_ShortDescription] ON [edfi].[TeachingCredentialBasisType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_TeachingCredentialBasisType] ON [edfi].[TeachingCredentialBasisType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for TeachingCredentialDescriptor
-- ----------------------------

CREATE TABLE [edfi].[TeachingCredentialDescriptor] (
[TeachingCredentialDescriptorId] int NOT NULL ,
[TeachingCredentialTypeId] int NULL ,
PRIMARY KEY ([TeachingCredentialDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table TeachingCredentialDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for TeachingCredentialType
-- ----------------------------

CREATE TABLE [edfi].[TeachingCredentialType] (
[TeachingCredentialTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([TeachingCredentialTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table TeachingCredentialType
-- ----------------------------
CREATE UNIQUE INDEX [AK_TeachingCredentialType_ShortDescription] ON [edfi].[TeachingCredentialType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_TeachingCredentialType] ON [edfi].[TeachingCredentialType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for TelephoneNumberType
-- ----------------------------

CREATE TABLE [edfi].[TelephoneNumberType] (
[TelephoneNumberTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([TelephoneNumberTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table TelephoneNumberType
-- ----------------------------
CREATE UNIQUE INDEX [AK_TelephoneNumberType_ShortDescription] ON [edfi].[TelephoneNumberType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_TelephoneNumberType] ON [edfi].[TelephoneNumberType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for TermType
-- ----------------------------

CREATE TABLE [edfi].[TermType] (
[TermTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([TermTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table TermType
-- ----------------------------
CREATE UNIQUE INDEX [AK_TermType_ShortDescription] ON [edfi].[TermType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_TermType] ON [edfi].[TermType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for TitleIPartAParticipantType
-- ----------------------------

CREATE TABLE [edfi].[TitleIPartAParticipantType] (
[TitleIPartAParticipantTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([TitleIPartAParticipantTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table TitleIPartAParticipantType
-- ----------------------------
CREATE UNIQUE INDEX [AK_TitleIPartAParticipantType_ShortDescription] ON [edfi].[TitleIPartAParticipantType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_TitleIPartAParticipantType] ON [edfi].[TitleIPartAParticipantType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for TitleIPartASchoolDesignationType
-- ----------------------------

CREATE TABLE [edfi].[TitleIPartASchoolDesignationType] (
[TitleIPartASchoolDesignationTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([TitleIPartASchoolDesignationTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table TitleIPartASchoolDesignationType
-- ----------------------------
CREATE UNIQUE INDEX [AK_TitleIPartASchoolDesignationType_ShortDescription] ON [edfi].[TitleIPartASchoolDesignationType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_TitleIPartASchoolDesignationType] ON [edfi].[TitleIPartASchoolDesignationType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for VisaType
-- ----------------------------

CREATE TABLE [edfi].[VisaType] (
[VisaTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([VisaTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table VisaType
-- ----------------------------
CREATE UNIQUE INDEX [AK_VisaType_ShortDescription] ON [edfi].[VisaType]
([ShortDescription] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO
CREATE UNIQUE INDEX [GUID_VisaType] ON [edfi].[VisaType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- Table structure for WeaponDescriptor
-- ----------------------------

CREATE TABLE [edfi].[WeaponDescriptor] (
[WeaponDescriptorId] int NOT NULL ,
[WeaponTypeId] int NULL ,
PRIMARY KEY ([WeaponDescriptorId])
)


GO

-- ----------------------------
-- Indexes structure for table WeaponDescriptor
-- ----------------------------

-- ----------------------------
-- Table structure for WeaponType
-- ----------------------------

CREATE TABLE [edfi].[WeaponType] (
[WeaponTypeId] int NOT NULL IDENTITY(1,1) ,
[CodeValue] nvarchar(50) NOT NULL ,
[Description] nvarchar(1024) NOT NULL ,
[ShortDescription] nvarchar(450) NOT NULL ,
[Id] uniqueidentifier NOT NULL DEFAULT (newid()) ,
[LastModifiedDate] datetime NOT NULL DEFAULT (getdate()) ,
[CreateDate] datetime NOT NULL DEFAULT (getdate()) ,
PRIMARY KEY ([WeaponTypeId])
)


GO

-- ----------------------------
-- Indexes structure for table WeaponType
-- ----------------------------
CREATE UNIQUE INDEX [GUID_WeaponType] ON [edfi].[WeaponType]
([Id] ASC) 
WITH (IGNORE_DUP_KEY = ON)
GO

-- ----------------------------
-- View structure for CurrentStaffEducationOrgAssignmentAssociation
-- ----------------------------

CREATE VIEW [edfi].[CurrentStaffEducationOrgAssignmentAssociation] AS 
SELECT *
FROM   edfi.StaffEducationOrganizationAssignmentAssociation SSA
WHERE (EndDate IS NULL)
                or (SSA.EndDate >= (select MAX(CD.Date) 
                                    from edfi.CalendarDate CD 
                                    where SSA.EducationOrganizationId = CD.EducationOrganizationId)
                                ) 
                or (SSA.EndDate >= (select MAX(Att.EventDate) 
                                    from edfi.StudentSectionAttendanceEvent Att)
                                )
--
GO

-- ----------------------------
-- View structure for CurrentStaffEducationOrgEmploymentAssociation
-- ----------------------------

CREATE VIEW [edfi].[CurrentStaffEducationOrgEmploymentAssociation] AS 
SELECT *
FROM   edfi.StaffEducationOrganizationEmploymentAssociation SSA
WHERE (EndDate IS NULL)
                or (SSA.EndDate >= (select MAX(CD.Date) 
                                    from edfi.CalendarDate CD 
                                    where SSA.EducationOrganizationId = CD.EducationOrganizationId)
                                ) 
                or (SSA.EndDate >= (select MAX(Att.EventDate) 
                                    from edfi.StudentSectionAttendanceEvent Att)
                                )
--
GO

-- ----------------------------
-- View structure for MinMaxDate
-- ----------------------------

CREATE VIEW [edfi].[MinMaxDate] AS 
SELECT Sch.SchoolId
		,ISNULL(MAX(Att.MaxDate), Getdate())as MaxDate
		,ISNULL(Min(Att.MinDate),'1900/1/1')as MinDate
		,ISNULL(Min(Att.SessionEndDate),'1900/1/1')as SessionEndDate
FROM edfi.School Sch
Left outer join
(
			SELECT   a.SchoolId,
				MAX(a.EventDate) as MaxDate,
				MIN(b.BeginDate) as MinDate, 
				Min(b.EndDate) as SessionEndDate
			FROM edfi.StudentSectionAttendanceEvent a
				Join edfi.Session b
					On a. SchoolId = b.SchoolId
			Group By  a.SchoolId
			Union All
			
			SELECT   a.SchoolId,
				MAX(a.EventDate) as MaxDate,
				MIN(b.BeginDate) as MinDate,
				Min(b.EndDate) as SessionEndDate
			FROM edfi.StudentSchoolAttendanceEvent a
				Join edfi.Session b
					On a. SchoolId = b.SchoolId
			Group By  a.SchoolId
		)Att
		on Sch.SchoolId = Att.SchoolId
Group by sch.SchoolId

--
GO

-- ----------------------------
-- View structure for SchoolList
-- ----------------------------

CREATE VIEW [edfi].[SchoolList] AS 
SELECT DISTINCT b.LocalEducationAgencyId, a.SchoolId
FROM 
	edfi.Grade a INNER JOIN
	edfi.School b
		ON a.SchoolId = b.SchoolId

--
GO

-- ----------------------------
-- Triggers structure for table AcademicWeek
-- ----------------------------

CREATE TRIGGER [edfi].[AcademicWeek_Delete_Event]
ON [edfi].[AcademicWeek]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'AcademicWeek', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Account
-- ----------------------------

CREATE TRIGGER [edfi].[Account_Delete_Event]
ON [edfi].[Account]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Account', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table AccountabilityRating
-- ----------------------------

CREATE TRIGGER [edfi].[AccountabilityRating_Delete_Event]
ON [edfi].[AccountabilityRating]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'AccountabilityRating', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Actual
-- ----------------------------

CREATE TRIGGER [edfi].[Actual_Delete_Event]
ON [edfi].[Actual]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Actual', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Assessment
-- ----------------------------

CREATE TRIGGER [edfi].[Assessment_Delete_Event]
ON [edfi].[Assessment]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Assessment', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table AssessmentFamily
-- ----------------------------

CREATE TRIGGER [edfi].[AssessmentFamily_Delete_Event]
ON [edfi].[AssessmentFamily]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'AssessmentFamily', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table AssessmentItem
-- ----------------------------

CREATE TRIGGER [edfi].[AssessmentItem_Delete_Event]
ON [edfi].[AssessmentItem]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'AssessmentItem', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table BellSchedule
-- ----------------------------

CREATE TRIGGER [edfi].[BellSchedule_Delete_Event]
ON [edfi].[BellSchedule]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'BellSchedule', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Budget
-- ----------------------------

CREATE TRIGGER [edfi].[Budget_Delete_Event]
ON [edfi].[Budget]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Budget', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table CalendarDate
-- ----------------------------

CREATE TRIGGER [edfi].[CalendarDate_Delete_Event]
ON [edfi].[CalendarDate]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'CalendarDate', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table ClassPeriod
-- ----------------------------

CREATE TRIGGER [edfi].[ClassPeriod_Delete_Event]
ON [edfi].[ClassPeriod]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'ClassPeriod', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Cohort
-- ----------------------------

CREATE TRIGGER [edfi].[Cohort_Delete_Event]
ON [edfi].[Cohort]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Cohort', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table CompetencyObjective
-- ----------------------------

CREATE TRIGGER [edfi].[CompetencyObjective_Delete_Event]
ON [edfi].[CompetencyObjective]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'CompetencyObjective', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table ContractedStaff
-- ----------------------------

CREATE TRIGGER [edfi].[ContractedStaff_Delete_Event]
ON [edfi].[ContractedStaff]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'ContractedStaff', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Course
-- ----------------------------

CREATE TRIGGER [edfi].[Course_Delete_Event]
ON [edfi].[Course]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Course', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table CourseOffering
-- ----------------------------

CREATE TRIGGER [edfi].[CourseOffering_Delete_Event]
ON [edfi].[CourseOffering]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'CourseOffering', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table CourseTranscript
-- ----------------------------

CREATE TRIGGER [edfi].[CourseTranscript_Delete_Event]
ON [edfi].[CourseTranscript]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'CourseTranscript', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table DisciplineAction
-- ----------------------------

CREATE TRIGGER [edfi].[DisciplineAction_Delete_Event]
ON [edfi].[DisciplineAction]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'DisciplineAction', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table DisciplineIncident
-- ----------------------------

CREATE TRIGGER [edfi].[DisciplineIncident_Delete_Event]
ON [edfi].[DisciplineIncident]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'DisciplineIncident', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationContent
-- ----------------------------

CREATE TRIGGER [edfi].[EducationContent_Delete_Event]
ON [edfi].[EducationContent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationContent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationOrganization
-- ----------------------------

CREATE TRIGGER [edfi].[EducationOrganization_Delete_Event]
ON [edfi].[EducationOrganization]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationOrganization', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationOrganizationInterventionPrescriptionAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[EducationOrganizationInterventionPrescriptionAssociation_Delete_Event]
ON [edfi].[EducationOrganizationInterventionPrescriptionAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationOrganizationInterventionPrescriptionAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationOrganizationNetwork
-- ----------------------------

CREATE TRIGGER [edfi].[EducationOrganizationNetwork_Delete_Event]
ON [edfi].[EducationOrganizationNetwork]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationOrganizationNetwork', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[EducationOrganization] base
            ON 
                d.EducationOrganizationNetworkId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationOrganizationNetworkAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[EducationOrganizationNetworkAssociation_Delete_Event]
ON [edfi].[EducationOrganizationNetworkAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationOrganizationNetworkAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationOrganizationPeerAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[EducationOrganizationPeerAssociation_Delete_Event]
ON [edfi].[EducationOrganizationPeerAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationOrganizationPeerAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table EducationServiceCenter
-- ----------------------------

CREATE TRIGGER [edfi].[EducationServiceCenter_Delete_Event]
ON [edfi].[EducationServiceCenter]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'EducationServiceCenter', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[EducationOrganization] base
            ON 
                d.EducationServiceCenterId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table FeederSchoolAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[FeederSchoolAssociation_Delete_Event]
ON [edfi].[FeederSchoolAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'FeederSchoolAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Grade
-- ----------------------------

CREATE TRIGGER [edfi].[Grade_Delete_Event]
ON [edfi].[Grade]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Grade', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table GradebookEntry
-- ----------------------------

CREATE TRIGGER [edfi].[GradebookEntry_Delete_Event]
ON [edfi].[GradebookEntry]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'GradebookEntry', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table GradingPeriod
-- ----------------------------

CREATE TRIGGER [edfi].[GradingPeriod_Delete_Event]
ON [edfi].[GradingPeriod]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'GradingPeriod', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table GraduationPlan
-- ----------------------------

CREATE TRIGGER [edfi].[GraduationPlan_Delete_Event]
ON [edfi].[GraduationPlan]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'GraduationPlan', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Intervention
-- ----------------------------

CREATE TRIGGER [edfi].[Intervention_Delete_Event]
ON [edfi].[Intervention]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Intervention', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table InterventionPrescription
-- ----------------------------

CREATE TRIGGER [edfi].[InterventionPrescription_Delete_Event]
ON [edfi].[InterventionPrescription]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'InterventionPrescription', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table InterventionStudy
-- ----------------------------

CREATE TRIGGER [edfi].[InterventionStudy_Delete_Event]
ON [edfi].[InterventionStudy]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'InterventionStudy', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table LearningObjective
-- ----------------------------

CREATE TRIGGER [edfi].[LearningObjective_Delete_Event]
ON [edfi].[LearningObjective]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'LearningObjective', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table LearningStandard
-- ----------------------------

CREATE TRIGGER [edfi].[LearningStandard_Delete_Event]
ON [edfi].[LearningStandard]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'LearningStandard', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table LeaveEvent
-- ----------------------------

CREATE TRIGGER [edfi].[LeaveEvent_Delete_Event]
ON [edfi].[LeaveEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'LeaveEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table LocalEducationAgency
-- ----------------------------

CREATE TRIGGER [edfi].[LocalEducationAgency_Delete_Event]
ON [edfi].[LocalEducationAgency]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'LocalEducationAgency', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[EducationOrganization] base
            ON 
                d.LocalEducationAgencyId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table Location
-- ----------------------------

CREATE TRIGGER [edfi].[Location_Delete_Event]
ON [edfi].[Location]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Location', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table ObjectiveAssessment
-- ----------------------------

CREATE TRIGGER [edfi].[ObjectiveAssessment_Delete_Event]
ON [edfi].[ObjectiveAssessment]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'ObjectiveAssessment', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table OpenStaffPosition
-- ----------------------------

CREATE TRIGGER [edfi].[OpenStaffPosition_Delete_Event]
ON [edfi].[OpenStaffPosition]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'OpenStaffPosition', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Parent
-- ----------------------------

CREATE TRIGGER [edfi].[Parent_Delete_Event]
ON [edfi].[Parent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Parent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Payroll
-- ----------------------------

CREATE TRIGGER [edfi].[Payroll_Delete_Event]
ON [edfi].[Payroll]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Payroll', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table PostSecondaryEvent
-- ----------------------------

CREATE TRIGGER [edfi].[PostSecondaryEvent_Delete_Event]
ON [edfi].[PostSecondaryEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'PostSecondaryEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Program
-- ----------------------------

CREATE TRIGGER [edfi].[Program_Delete_Event]
ON [edfi].[Program]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Program', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table ReportCard
-- ----------------------------

CREATE TRIGGER [edfi].[ReportCard_Delete_Event]
ON [edfi].[ReportCard]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'ReportCard', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table RestraintEvent
-- ----------------------------

CREATE TRIGGER [edfi].[RestraintEvent_Delete_Event]
ON [edfi].[RestraintEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'RestraintEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table School
-- ----------------------------

CREATE TRIGGER [edfi].[School_Delete_Event]
ON [edfi].[School]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'School', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[EducationOrganization] base
            ON 
                d.SchoolId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table Section
-- ----------------------------

CREATE TRIGGER [edfi].[Section_Delete_Event]
ON [edfi].[Section]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Section', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table SectionAttendanceTakenEvent
-- ----------------------------

CREATE TRIGGER [edfi].[SectionAttendanceTakenEvent_Delete_Event]
ON [edfi].[SectionAttendanceTakenEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'SectionAttendanceTakenEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Session
-- ----------------------------

CREATE TRIGGER [edfi].[Session_Delete_Event]
ON [edfi].[Session]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Session', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table Staff
-- ----------------------------

CREATE TRIGGER [edfi].[Staff_Delete_Event]
ON [edfi].[Staff]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Staff', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StaffCohortAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StaffCohortAssociation_Delete_Event]
ON [edfi].[StaffCohortAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StaffCohortAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StaffEducationOrganizationAssignmentAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StaffEducationOrganizationAssignmentAssociation_Delete_Event]
ON [edfi].[StaffEducationOrganizationAssignmentAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StaffEducationOrganizationAssignmentAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StaffEducationOrganizationEmploymentAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StaffEducationOrganizationEmploymentAssociation_Delete_Event]
ON [edfi].[StaffEducationOrganizationEmploymentAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StaffEducationOrganizationEmploymentAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StaffProgramAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StaffProgramAssociation_Delete_Event]
ON [edfi].[StaffProgramAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StaffProgramAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StaffSchoolAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StaffSchoolAssociation_Delete_Event]
ON [edfi].[StaffSchoolAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StaffSchoolAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StaffSectionAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StaffSectionAssociation_Delete_Event]
ON [edfi].[StaffSectionAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StaffSectionAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StateEducationAgency
-- ----------------------------

CREATE TRIGGER [edfi].[StateEducationAgency_Delete_Event]
ON [edfi].[StateEducationAgency]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StateEducationAgency', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[EducationOrganization] base
            ON 
                d.StateEducationAgencyId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table Student
-- ----------------------------

CREATE TRIGGER [edfi].[Student_Delete_Event]
ON [edfi].[Student]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'Student', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentAcademicRecord
-- ----------------------------

CREATE TRIGGER [edfi].[StudentAcademicRecord_Delete_Event]
ON [edfi].[StudentAcademicRecord]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentAcademicRecord', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentAssessment
-- ----------------------------

CREATE TRIGGER [edfi].[StudentAssessment_Delete_Event]
ON [edfi].[StudentAssessment]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentAssessment', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentCohortAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentCohortAssociation_Delete_Event]
ON [edfi].[StudentCohortAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentCohortAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentCompetencyObjective
-- ----------------------------

CREATE TRIGGER [edfi].[StudentCompetencyObjective_Delete_Event]
ON [edfi].[StudentCompetencyObjective]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentCompetencyObjective', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentCTEProgramAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentCTEProgramAssociation_Delete_Event]
ON [edfi].[StudentCTEProgramAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentCTEProgramAssociation', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[StudentProgramAssociation] base
            ON 
                d.StudentUSI = base.StudentUSI
                AND d.ProgramTypeId = base.ProgramTypeId
                AND d.ProgramName = base.ProgramName
                AND d.ProgramEducationOrganizationId = base.ProgramEducationOrganizationId
                AND d.BeginDate = base.BeginDate
                AND d.EducationOrganizationId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentDisciplineIncidentAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentDisciplineIncidentAssociation_Delete_Event]
ON [edfi].[StudentDisciplineIncidentAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentDisciplineIncidentAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentEducationOrganizationAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentEducationOrganizationAssociation_Delete_Event]
ON [edfi].[StudentEducationOrganizationAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentEducationOrganizationAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentGradebookEntry
-- ----------------------------

CREATE TRIGGER [edfi].[StudentGradebookEntry_Delete_Event]
ON [edfi].[StudentGradebookEntry]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentGradebookEntry', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentInterventionAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentInterventionAssociation_Delete_Event]
ON [edfi].[StudentInterventionAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentInterventionAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentInterventionAttendanceEvent
-- ----------------------------

CREATE TRIGGER [edfi].[StudentInterventionAttendanceEvent_Delete_Event]
ON [edfi].[StudentInterventionAttendanceEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentInterventionAttendanceEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentLearningObjective
-- ----------------------------

CREATE TRIGGER [edfi].[StudentLearningObjective_Delete_Event]
ON [edfi].[StudentLearningObjective]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentLearningObjective', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentMigrantEducationProgramAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentMigrantEducationProgramAssociation_Delete_Event]
ON [edfi].[StudentMigrantEducationProgramAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentMigrantEducationProgramAssociation', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[StudentProgramAssociation] base
            ON 
                d.StudentUSI = base.StudentUSI
                AND d.ProgramTypeId = base.ProgramTypeId
                AND d.ProgramName = base.ProgramName
                AND d.ProgramEducationOrganizationId = base.ProgramEducationOrganizationId
                AND d.BeginDate = base.BeginDate
                AND d.EducationOrganizationId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentParentAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentParentAssociation_Delete_Event]
ON [edfi].[StudentParentAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentParentAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentProgramAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentProgramAssociation_Delete_Event]
ON [edfi].[StudentProgramAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentProgramAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentProgramAttendanceEvent
-- ----------------------------

CREATE TRIGGER [edfi].[StudentProgramAttendanceEvent_Delete_Event]
ON [edfi].[StudentProgramAttendanceEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentProgramAttendanceEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentSchoolAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentSchoolAssociation_Delete_Event]
ON [edfi].[StudentSchoolAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentSchoolAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentSchoolAttendanceEvent
-- ----------------------------

CREATE TRIGGER [edfi].[StudentSchoolAttendanceEvent_Delete_Event]
ON [edfi].[StudentSchoolAttendanceEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentSchoolAttendanceEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentSectionAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentSectionAssociation_Delete_Event]
ON [edfi].[StudentSectionAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentSectionAssociation', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentSectionAttendanceEvent
-- ----------------------------

CREATE TRIGGER [edfi].[StudentSectionAttendanceEvent_Delete_Event]
ON [edfi].[StudentSectionAttendanceEvent]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentSectionAttendanceEvent', 'edfi'
	FROM deleted;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentSpecialEducationProgramAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentSpecialEducationProgramAssociation_Delete_Event]
ON [edfi].[StudentSpecialEducationProgramAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentSpecialEducationProgramAssociation', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[StudentProgramAssociation] base
            ON 
                d.StudentUSI = base.StudentUSI
                AND d.ProgramTypeId = base.ProgramTypeId
                AND d.ProgramName = base.ProgramName
                AND d.ProgramEducationOrganizationId = base.ProgramEducationOrganizationId
                AND d.BeginDate = base.BeginDate
                AND d.EducationOrganizationId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Triggers structure for table StudentTitleIPartAProgramAssociation
-- ----------------------------

CREATE TRIGGER [edfi].[StudentTitleIPartAProgramAssociation_Delete_Event]
ON [edfi].[StudentTitleIPartAProgramAssociation]
AFTER DELETE
AS
BEGIN
	SET NOCOUNT ON;
	
	INSERT INTO dbo.DeleteEvent (Id, DeletionDate, TableName, SchemaName)
	SELECT Id, GETUTCDATE(), 'StudentTitleIPartAProgramAssociation', 'edfi'
	FROM deleted d
        INNER JOIN [edfi].[StudentProgramAssociation] base
            ON 
                d.StudentUSI = base.StudentUSI
                AND d.ProgramTypeId = base.ProgramTypeId
                AND d.ProgramName = base.ProgramName
                AND d.ProgramEducationOrganizationId = base.ProgramEducationOrganizationId
                AND d.BeginDate = base.BeginDate
                AND d.EducationOrganizationId = base.EducationOrganizationId
;
END
--

GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AcademicSubjectDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AcademicSubjectDescriptor] ADD FOREIGN KEY ([AcademicSubjectTypeId]) REFERENCES [edfi].[AcademicSubjectType] ([AcademicSubjectTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AcademicSubjectDescriptor] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AcademicWeek]
-- ----------------------------
ALTER TABLE [edfi].[AcademicWeek] ADD FOREIGN KEY ([EducationOrganizationId], [BeginDate]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AcademicWeek] ADD FOREIGN KEY ([EducationOrganizationId], [EndDate]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AccommodationDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AccommodationDescriptor] ADD FOREIGN KEY ([AccommodationTypeId]) REFERENCES [edfi].[AccommodationType] ([AccommodationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AccommodationDescriptor] ADD FOREIGN KEY ([AccommodationDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Account]
-- ----------------------------
ALTER TABLE [edfi].[Account] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AccountabilityRating]
-- ----------------------------
ALTER TABLE [edfi].[AccountabilityRating] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AccountabilityRating] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AccountCode]
-- ----------------------------
ALTER TABLE [edfi].[AccountCode] ADD FOREIGN KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear]) REFERENCES [edfi].[Account] ([EducationOrganizationId], [AccountNumber], [FiscalYear]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AccountCode] ADD FOREIGN KEY ([AccountCodeDescriptorId]) REFERENCES [edfi].[AccountCodeDescriptor] ([AccountCodeDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AccountCodeDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AccountCodeDescriptor] ADD FOREIGN KEY ([AccountCodeDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AchievementCategoryDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AchievementCategoryDescriptor] ADD FOREIGN KEY ([AchievementCategoryTypeId]) REFERENCES [edfi].[AchievementCategoryType] ([AchievementCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AchievementCategoryDescriptor] ADD FOREIGN KEY ([AchievementCategoryDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Actual]
-- ----------------------------
ALTER TABLE [edfi].[Actual] ADD FOREIGN KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear]) REFERENCES [edfi].[Account] ([EducationOrganizationId], [AccountNumber], [FiscalYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AdministrativeFundingControlDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AdministrativeFundingControlDescriptor] ADD FOREIGN KEY ([AdministrativeFundingControlTypeId]) REFERENCES [edfi].[AdministrativeFundingControlType] ([AdministrativeFundingControlTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AdministrativeFundingControlDescriptor] ADD FOREIGN KEY ([AdministrativeFundingControlDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Assessment]
-- ----------------------------
ALTER TABLE [edfi].[Assessment] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Assessment] ADD FOREIGN KEY ([AssessedGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Assessment] ADD FOREIGN KEY ([AssessmentCategoryTypeId]) REFERENCES [edfi].[AssessmentCategoryType] ([AssessmentCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Assessment] ADD FOREIGN KEY ([AssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamily] ([AssessmentFamilyTitle]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Assessment] ADD FOREIGN KEY ([AssessmentPeriodDescriptorId]) REFERENCES [edfi].[AssessmentPeriodDescriptor] ([AssessmentPeriodDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Assessment] ADD FOREIGN KEY ([LowestAssessedGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentContentStandard]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentContentStandard] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [AssessmentVersion]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentContentStandard] ADD FOREIGN KEY ([MandatingEducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentContentStandard] ADD FOREIGN KEY ([PublicationStatusTypeId]) REFERENCES [edfi].[PublicationStatusType] ([PublicationStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentContentStandardAuthor]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentContentStandardAuthor] ADD FOREIGN KEY ([AssessmentVersion], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId]) REFERENCES [edfi].[AssessmentContentStandard] ([AssessmentVersion], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentFamily]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentFamily] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamily] ADD FOREIGN KEY ([AssessedGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamily] ADD FOREIGN KEY ([AssessmentCategoryTypeId]) REFERENCES [edfi].[AssessmentCategoryType] ([AssessmentCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamily] ADD FOREIGN KEY ([ParentAssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamily] ([AssessmentFamilyTitle]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamily] ADD FOREIGN KEY ([LowestAssessedGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentFamilyAssessmentPeriod]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentFamilyAssessmentPeriod] ADD FOREIGN KEY ([AssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamily] ([AssessmentFamilyTitle]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamilyAssessmentPeriod] ADD FOREIGN KEY ([AssessmentPeriodDescriptorId]) REFERENCES [edfi].[AssessmentPeriodDescriptor] ([AssessmentPeriodDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentFamilyContentStandard]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentFamilyContentStandard] ADD FOREIGN KEY ([AssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamily] ([AssessmentFamilyTitle]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamilyContentStandard] ADD FOREIGN KEY ([MandatingEducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamilyContentStandard] ADD FOREIGN KEY ([PublicationStatusTypeId]) REFERENCES [edfi].[PublicationStatusType] ([PublicationStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentFamilyContentStandardAuthor]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentFamilyContentStandardAuthor] ADD FOREIGN KEY ([AssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamilyContentStandard] ([AssessmentFamilyTitle]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentFamilyIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentFamilyIdentificationCode] ADD FOREIGN KEY ([AssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamily] ([AssessmentFamilyTitle]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamilyIdentificationCode] ADD FOREIGN KEY ([AssessmentIdentificationSystemTypeId]) REFERENCES [edfi].[AssessmentIdentificationSystemType] ([AssessmentIdentificationSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentFamilyLanguage]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentFamilyLanguage] ADD FOREIGN KEY ([AssessmentFamilyTitle]) REFERENCES [edfi].[AssessmentFamily] ([AssessmentFamilyTitle]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentFamilyLanguage] ADD FOREIGN KEY ([LanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentIdentificationCode] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentIdentificationCode] ADD FOREIGN KEY ([AssessmentIdentificationSystemTypeId]) REFERENCES [edfi].[AssessmentIdentificationSystemType] ([AssessmentIdentificationSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentItem]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentItem] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentItem] ADD FOREIGN KEY ([AssessmentItemCategoryTypeId]) REFERENCES [edfi].[AssessmentItemCategoryType] ([AssessmentItemCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentItemLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentItemLearningStandard] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[AssessmentItem] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentItemLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentLanguage]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentLanguage] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentLanguage] ADD FOREIGN KEY ([LanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentPerformanceLevel]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentPerformanceLevel] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentPerformanceLevel] ADD FOREIGN KEY ([AssessmentReportingMethodTypeId]) REFERENCES [edfi].[AssessmentReportingMethodType] ([AssessmentReportingMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentPerformanceLevel] ADD FOREIGN KEY ([PerformanceLevelDescriptorId]) REFERENCES [edfi].[PerformanceLevelDescriptor] ([PerformanceLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentPerformanceLevel] ADD FOREIGN KEY ([ResultDatatypeTypeId]) REFERENCES [edfi].[ResultDatatypeType] ([ResultDatatypeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentPeriodDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentPeriodDescriptor] ADD FOREIGN KEY ([AssessmentPeriodDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentProgram]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentProgram] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentProgram] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentScore]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentScore] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentScore] ADD FOREIGN KEY ([AssessmentReportingMethodTypeId]) REFERENCES [edfi].[AssessmentReportingMethodType] ([AssessmentReportingMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentScore] ADD FOREIGN KEY ([ResultDatatypeTypeId]) REFERENCES [edfi].[ResultDatatypeType] ([ResultDatatypeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AssessmentSection]
-- ----------------------------
ALTER TABLE [edfi].[AssessmentSection] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AssessmentSection] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[AttendanceEventCategoryDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[AttendanceEventCategoryDescriptor] ADD FOREIGN KEY ([AttendanceEventCategoryTypeId]) REFERENCES [edfi].[AttendanceEventCategoryType] ([AttendanceEventCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[AttendanceEventCategoryDescriptor] ADD FOREIGN KEY ([AttendanceEventCategoryDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[BehaviorDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[BehaviorDescriptor] ADD FOREIGN KEY ([BehaviorTypeId]) REFERENCES [edfi].[BehaviorType] ([BehaviorTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[BehaviorDescriptor] ADD FOREIGN KEY ([BehaviorDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[BellSchedule]
-- ----------------------------
ALTER TABLE [edfi].[BellSchedule] ADD FOREIGN KEY ([SchoolId], [Date]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[BellSchedule] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[BellSchedule] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[BellScheduleMeetingTime]
-- ----------------------------
ALTER TABLE [edfi].[BellScheduleMeetingTime] ADD FOREIGN KEY ([SchoolId], [GradeLevelDescriptorId], [Date], [BellScheduleName]) REFERENCES [edfi].[BellSchedule] ([SchoolId], [GradeLevelDescriptorId], [Date], [BellScheduleName]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[BellScheduleMeetingTime] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName]) REFERENCES [edfi].[ClassPeriod] ([SchoolId], [ClassPeriodName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Budget]
-- ----------------------------
ALTER TABLE [edfi].[Budget] ADD FOREIGN KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear]) REFERENCES [edfi].[Account] ([EducationOrganizationId], [AccountNumber], [FiscalYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CalendarDate]
-- ----------------------------
ALTER TABLE [edfi].[CalendarDate] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CalendarDateCalendarEvent]
-- ----------------------------
ALTER TABLE [edfi].[CalendarDateCalendarEvent] ADD FOREIGN KEY ([EducationOrganizationId], [Date]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CalendarDateCalendarEvent] ADD FOREIGN KEY ([CalendarEventDescriptorId]) REFERENCES [edfi].[CalendarEventDescriptor] ([CalendarEventDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CalendarEventDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[CalendarEventDescriptor] ADD FOREIGN KEY ([CalendarEventTypeId]) REFERENCES [edfi].[CalendarEventType] ([CalendarEventTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CalendarEventDescriptor] ADD FOREIGN KEY ([CalendarEventDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ClassPeriod]
-- ----------------------------
ALTER TABLE [edfi].[ClassPeriod] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ClassroomPositionDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ClassroomPositionDescriptor] ADD FOREIGN KEY ([ClassroomPositionTypeId]) REFERENCES [edfi].[ClassroomPositionType] ([ClassroomPositionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ClassroomPositionDescriptor] ADD FOREIGN KEY ([ClassroomPositionDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Cohort]
-- ----------------------------
ALTER TABLE [edfi].[Cohort] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Cohort] ADD FOREIGN KEY ([CohortScopeTypeId]) REFERENCES [edfi].[CohortScopeType] ([CohortScopeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Cohort] ADD FOREIGN KEY ([CohortTypeId]) REFERENCES [edfi].[CohortType] ([CohortTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Cohort] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CohortProgram]
-- ----------------------------
ALTER TABLE [edfi].[CohortProgram] ADD FOREIGN KEY ([EducationOrganizationId], [CohortIdentifier]) REFERENCES [edfi].[Cohort] ([EducationOrganizationId], [CohortIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CohortProgram] ADD FOREIGN KEY ([ProgramEducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CompetencyLevelDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[CompetencyLevelDescriptor] ADD FOREIGN KEY ([CompetencyLevelDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CompetencyLevelDescriptor] ADD FOREIGN KEY ([PerformanceBaseConversionTypeId]) REFERENCES [edfi].[PerformanceBaseConversionType] ([PerformanceBaseConversionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CompetencyObjective]
-- ----------------------------
ALTER TABLE [edfi].[CompetencyObjective] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CompetencyObjective] ADD FOREIGN KEY ([ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ContinuationOfServicesReasonDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ContinuationOfServicesReasonDescriptor] ADD FOREIGN KEY ([ContinuationOfServicesReasonTypeId]) REFERENCES [edfi].[ContinuationOfServicesReasonType] ([ContinuationOfServicesReasonTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ContinuationOfServicesReasonDescriptor] ADD FOREIGN KEY ([ContinuationOfServicesReasonDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ContractedStaff]
-- ----------------------------
ALTER TABLE [edfi].[ContractedStaff] ADD FOREIGN KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear]) REFERENCES [edfi].[Account] ([EducationOrganizationId], [AccountNumber], [FiscalYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ContractedStaff] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Course]
-- ----------------------------
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([CareerPathwayTypeId]) REFERENCES [edfi].[CareerPathwayType] ([CareerPathwayTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([CourseDefinedByTypeId]) REFERENCES [edfi].[CourseDefinedByType] ([CourseDefinedByTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([CourseGPAApplicabilityTypeId]) REFERENCES [edfi].[CourseGPAApplicabilityType] ([CourseGPAApplicabilityTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([MaximumAvailableCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([MinimumAvailableCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Course] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseCompetencyLevel]
-- ----------------------------
ALTER TABLE [edfi].[CourseCompetencyLevel] ADD FOREIGN KEY ([CompetencyLevelDescriptorId]) REFERENCES [edfi].[CompetencyLevelDescriptor] ([CompetencyLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseCompetencyLevel] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[CourseGradeLevel] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[CourseIdentificationCode] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseIdentificationCode] ADD FOREIGN KEY ([CourseCodeSystemTypeId]) REFERENCES [edfi].[CourseCodeSystemType] ([CourseCodeSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseLearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[CourseLearningObjective] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseLearningObjective] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[CourseLearningStandard] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseLevelCharacteristic]
-- ----------------------------
ALTER TABLE [edfi].[CourseLevelCharacteristic] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseLevelCharacteristic] ADD FOREIGN KEY ([CourseLevelCharacteristicTypeId]) REFERENCES [edfi].[CourseLevelCharacteristicType] ([CourseLevelCharacteristicTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseOffering]
-- ----------------------------
ALTER TABLE [edfi].[CourseOffering] ADD FOREIGN KEY ([EducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseOffering] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseOffering] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Session] ([SchoolId], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseOfferingCurriculumUsed]
-- ----------------------------
ALTER TABLE [edfi].[CourseOfferingCurriculumUsed] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear], [LocalCourseCode]) REFERENCES [edfi].[CourseOffering] ([SchoolId], [TermTypeId], [SchoolYear], [LocalCourseCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseOfferingCurriculumUsed] ADD FOREIGN KEY ([CurriculumUsedTypeId]) REFERENCES [edfi].[CurriculumUsedType] ([CurriculumUsedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseTranscript]
-- ----------------------------
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([CourseAttemptResultTypeId]) REFERENCES [edfi].[CourseAttemptResultType] ([CourseAttemptResultTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([CourseRepeatCodeTypeId]) REFERENCES [edfi].[CourseRepeatCodeType] ([CourseRepeatCodeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([AttemptedCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([EarnedCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([MethodCreditEarnedTypeId]) REFERENCES [edfi].[MethodCreditEarnedType] ([MethodCreditEarnedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscript] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) REFERENCES [edfi].[StudentAcademicRecord] ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseTranscriptAdditionalCredit]
-- ----------------------------
ALTER TABLE [edfi].[CourseTranscriptAdditionalCredit] ADD FOREIGN KEY ([AdditionalCreditTypeId]) REFERENCES [edfi].[AdditionalCreditType] ([AdditionalCreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CourseTranscriptAdditionalCredit] ADD FOREIGN KEY ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [EducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId]) REFERENCES [edfi].[CourseTranscript] ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [EducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CourseTranscriptExternalCourse]
-- ----------------------------
ALTER TABLE [edfi].[CourseTranscriptExternalCourse] ADD FOREIGN KEY ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [EducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId]) REFERENCES [edfi].[CourseTranscript] ([StudentUSI], [SchoolYear], [TermTypeId], [CourseEducationOrganizationId], [EducationOrganizationId], [CourseCode], [CourseAttemptResultTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[CredentialFieldDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[CredentialFieldDescriptor] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[CredentialFieldDescriptor] ADD FOREIGN KEY ([CredentialFieldDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DiagnosisDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[DiagnosisDescriptor] ADD FOREIGN KEY ([DiagnosisDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DiagnosisDescriptor] ADD FOREIGN KEY ([DiagnosisTypeId]) REFERENCES [edfi].[DiagnosisType] ([DiagnosisTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisabilityDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[DisabilityDescriptor] ADD FOREIGN KEY ([DisabilityDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisabilityDescriptor] ADD FOREIGN KEY ([DisabilityCategoryTypeId]) REFERENCES [edfi].[DisabilityCategoryType] ([DisabilityCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisabilityDescriptor] ADD FOREIGN KEY ([DisabilityTypeId]) REFERENCES [edfi].[DisabilityType] ([DisabilityTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineAction]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineAction] ADD FOREIGN KEY ([DisciplineActionLengthDifferenceReasonTypeId]) REFERENCES [edfi].[DisciplineActionLengthDifferenceReasonType] ([DisciplineActionLengthDifferenceReasonTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineAction] ADD FOREIGN KEY ([AssignmentSchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineAction] ADD FOREIGN KEY ([ResponsibilitySchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineAction] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineActionDiscipline]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineActionDiscipline] ADD FOREIGN KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate]) REFERENCES [edfi].[DisciplineAction] ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineActionDiscipline] ADD FOREIGN KEY ([DisciplineDescriptorId]) REFERENCES [edfi].[DisciplineDescriptor] ([DisciplineDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineActionDisciplineIncident]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineActionDisciplineIncident] ADD FOREIGN KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate]) REFERENCES [edfi].[DisciplineAction] ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineActionDisciplineIncident] ADD FOREIGN KEY ([SchoolId], [IncidentIdentifier]) REFERENCES [edfi].[DisciplineIncident] ([SchoolId], [IncidentIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineActionStaff]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineActionStaff] ADD FOREIGN KEY ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate]) REFERENCES [edfi].[DisciplineAction] ([StudentUSI], [DisciplineActionIdentifier], [DisciplineDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineActionStaff] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineDescriptor] ADD FOREIGN KEY ([DisciplineDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineDescriptor] ADD FOREIGN KEY ([DisciplineTypeId]) REFERENCES [edfi].[DisciplineType] ([DisciplineTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineIncident]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineIncident] ADD FOREIGN KEY ([IncidentLocationTypeId]) REFERENCES [edfi].[IncidentLocationType] ([IncidentLocationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineIncident] ADD FOREIGN KEY ([ReporterDescriptionDescriptorId]) REFERENCES [edfi].[ReporterDescriptionDescriptor] ([ReporterDescriptionDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineIncident] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineIncident] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineIncidentBehavior]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineIncidentBehavior] ADD FOREIGN KEY ([BehaviorDescriptorId]) REFERENCES [edfi].[BehaviorDescriptor] ([BehaviorDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineIncidentBehavior] ADD FOREIGN KEY ([SchoolId], [IncidentIdentifier]) REFERENCES [edfi].[DisciplineIncident] ([SchoolId], [IncidentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[DisciplineIncidentWeapon]
-- ----------------------------
ALTER TABLE [edfi].[DisciplineIncidentWeapon] ADD FOREIGN KEY ([SchoolId], [IncidentIdentifier]) REFERENCES [edfi].[DisciplineIncident] ([SchoolId], [IncidentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[DisciplineIncidentWeapon] ADD FOREIGN KEY ([WeaponDescriptorId]) REFERENCES [edfi].[WeaponDescriptor] ([WeaponDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContent]
-- ----------------------------
ALTER TABLE [edfi].[EducationContent] ADD FOREIGN KEY ([ContentClassTypeId]) REFERENCES [edfi].[ContentClassType] ([ContentClassTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContent] ADD FOREIGN KEY ([CostRateTypeId]) REFERENCES [edfi].[CostRateType] ([CostRateTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContent] ADD FOREIGN KEY ([InteractivityStyleTypeId]) REFERENCES [edfi].[InteractivityStyleType] ([InteractivityStyleTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContent] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentAppropriateGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentAppropriateGradeLevel] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContentAppropriateGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentAppropriateSex]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentAppropriateSex] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContentAppropriateSex] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentAuthor]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentAuthor] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentDerivativeSourceEducationContent]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentDerivativeSourceEducationContent] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContentDerivativeSourceEducationContent] ADD FOREIGN KEY ([DerivativeSourceContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentDerivativeSourceLearningResourceMetadataURI]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentDerivativeSourceLearningResourceMetadataURI] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentDerivativeSourceURI]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentDerivativeSourceURI] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationContentLanguage]
-- ----------------------------
ALTER TABLE [edfi].[EducationContentLanguage] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationContentLanguage] ADD FOREIGN KEY ([LanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganization]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganization] ADD FOREIGN KEY ([OperationalStatusTypeId]) REFERENCES [edfi].[OperationalStatusType] ([OperationalStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationAddress]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationAddress] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationAddress] ADD FOREIGN KEY ([StateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationCategory]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationCategory] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationCategory] ADD FOREIGN KEY ([EducationOrganizationCategoryTypeId]) REFERENCES [edfi].[EducationOrganizationCategoryType] ([EducationOrganizationCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationIdentificationCode] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationIdentificationCode] ADD FOREIGN KEY ([EducationOrganizationIdentificationSystemTypeId]) REFERENCES [edfi].[EducationOrganizationIdentificationSystemType] ([EducationOrganizationIdentificationSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationInstitutionTelephone]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationInstitutionTelephone] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationInstitutionTelephone] ADD FOREIGN KEY ([InstitutionTelephoneNumberTypeId]) REFERENCES [edfi].[InstitutionTelephoneNumberType] ([InstitutionTelephoneNumberTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationInternationalAddress]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationInternationalAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationInternationalAddress] ADD FOREIGN KEY ([CountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationInternationalAddress] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationInterventionPrescriptionAssociation]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationInterventionPrescriptionAssociation] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationInterventionPrescriptionAssociation] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [InterventionPrescriptionEducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationNetwork]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationNetwork] ADD FOREIGN KEY ([EducationOrganizationNetworkId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationNetwork] ADD FOREIGN KEY ([NetworkPurposeTypeId]) REFERENCES [edfi].[NetworkPurposeType] ([NetworkPurposeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationNetworkAssociation]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationNetworkAssociation] ADD FOREIGN KEY ([MemberEducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationNetworkAssociation] ADD FOREIGN KEY ([EducationOrganizationNetworkId]) REFERENCES [edfi].[EducationOrganizationNetwork] ([EducationOrganizationNetworkId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationOrganizationPeerAssociation]
-- ----------------------------
ALTER TABLE [edfi].[EducationOrganizationPeerAssociation] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationOrganizationPeerAssociation] ADD FOREIGN KEY ([PeerEducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EducationServiceCenter]
-- ----------------------------
ALTER TABLE [edfi].[EducationServiceCenter] ADD FOREIGN KEY ([EducationServiceCenterId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EducationServiceCenter] ADD FOREIGN KEY ([StateEducationAgencyId]) REFERENCES [edfi].[StateEducationAgency] ([StateEducationAgencyId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EmploymentStatusDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[EmploymentStatusDescriptor] ADD FOREIGN KEY ([EmploymentStatusDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EmploymentStatusDescriptor] ADD FOREIGN KEY ([EmploymentStatusTypeId]) REFERENCES [edfi].[EmploymentStatusType] ([EmploymentStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[EntryTypeDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[EntryTypeDescriptor] ADD FOREIGN KEY ([EntryTypeDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[EntryTypeDescriptor] ADD FOREIGN KEY ([EntryTypeId]) REFERENCES [edfi].[EntryType] ([EntryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ExitWithdrawTypeDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ExitWithdrawTypeDescriptor] ADD FOREIGN KEY ([ExitWithdrawTypeDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ExitWithdrawTypeDescriptor] ADD FOREIGN KEY ([ExitWithdrawTypeId]) REFERENCES [edfi].[ExitWithdrawType] ([ExitWithdrawTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[FeederSchoolAssociation]
-- ----------------------------
ALTER TABLE [edfi].[FeederSchoolAssociation] ADD FOREIGN KEY ([FeederSchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[FeederSchoolAssociation] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Grade]
-- ----------------------------
ALTER TABLE [edfi].[Grade] ADD FOREIGN KEY ([GradeTypeId]) REFERENCES [edfi].[GradeType] ([GradeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Grade] ADD FOREIGN KEY ([GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[GradingPeriod] ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Grade] ADD FOREIGN KEY ([PerformanceBaseConversionTypeId]) REFERENCES [edfi].[PerformanceBaseConversionType] ([PerformanceBaseConversionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Grade] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) REFERENCES [edfi].[StudentSectionAssociation] ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GradebookEntry]
-- ----------------------------
ALTER TABLE [edfi].[GradebookEntry] ADD FOREIGN KEY ([GradebookEntryTypeId]) REFERENCES [edfi].[GradebookEntryType] ([GradebookEntryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GradebookEntry] ADD FOREIGN KEY ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) REFERENCES [edfi].[GradingPeriod] ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GradebookEntry] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GradebookEntryLearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[GradebookEntryLearningObjective] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned]) REFERENCES [edfi].[GradebookEntry] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned]) ON DELETE CASCADE ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[GradebookEntryLearningObjective] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GradebookEntryLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[GradebookEntryLearningStandard] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned]) REFERENCES [edfi].[GradebookEntry] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned]) ON DELETE CASCADE ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[GradebookEntryLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GradeLevelDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[GradeLevelDescriptor] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GradeLevelDescriptor] ADD FOREIGN KEY ([GradeLevelTypeId]) REFERENCES [edfi].[GradeLevelType] ([GradeLevelTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GradingPeriod]
-- ----------------------------
ALTER TABLE [edfi].[GradingPeriod] ADD FOREIGN KEY ([EducationOrganizationId], [BeginDate]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GradingPeriod] ADD FOREIGN KEY ([EducationOrganizationId], [EndDate]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GradingPeriod] ADD FOREIGN KEY ([GradingPeriodDescriptorId]) REFERENCES [edfi].[GradingPeriodDescriptor] ([GradingPeriodDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GradingPeriodDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[GradingPeriodDescriptor] ADD FOREIGN KEY ([GradingPeriodDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GradingPeriodDescriptor] ADD FOREIGN KEY ([GradingPeriodTypeId]) REFERENCES [edfi].[GradingPeriodType] ([GradingPeriodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GraduationPlan]
-- ----------------------------
ALTER TABLE [edfi].[GraduationPlan] ADD FOREIGN KEY ([TotalRequiredCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlan] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlan] ADD FOREIGN KEY ([GraduationPlanTypeDescriptorId]) REFERENCES [edfi].[GraduationPlanTypeDescriptor] ([GraduationPlanTypeDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlan] ADD FOREIGN KEY ([GraduationSchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GraduationPlanCreditsByCourse]
-- ----------------------------
ALTER TABLE [edfi].[GraduationPlanCreditsByCourse] ADD FOREIGN KEY ([CreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlanCreditsByCourse] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlanCreditsByCourse] ADD FOREIGN KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear]) REFERENCES [edfi].[GraduationPlan] ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GraduationPlanCreditsByCourseCourse]
-- ----------------------------
ALTER TABLE [edfi].[GraduationPlanCreditsByCourseCourse] ADD FOREIGN KEY ([CourseEducationOrganizationId], [CourseCode]) REFERENCES [edfi].[Course] ([EducationOrganizationId], [CourseCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlanCreditsByCourseCourse] ADD FOREIGN KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear], [CourseSetName]) REFERENCES [edfi].[GraduationPlanCreditsByCourse] ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear], [CourseSetName]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GraduationPlanCreditsBySubject]
-- ----------------------------
ALTER TABLE [edfi].[GraduationPlanCreditsBySubject] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlanCreditsBySubject] ADD FOREIGN KEY ([CreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlanCreditsBySubject] ADD FOREIGN KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear]) REFERENCES [edfi].[GraduationPlan] ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[GraduationPlanTypeDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[GraduationPlanTypeDescriptor] ADD FOREIGN KEY ([GraduationPlanTypeDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[GraduationPlanTypeDescriptor] ADD FOREIGN KEY ([GraduationPlanTypeId]) REFERENCES [edfi].[GraduationPlanType] ([GraduationPlanTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Intervention]
-- ----------------------------
ALTER TABLE [edfi].[Intervention] ADD FOREIGN KEY ([DeliveryMethodTypeId]) REFERENCES [edfi].[DeliveryMethodType] ([DeliveryMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Intervention] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Intervention] ADD FOREIGN KEY ([InterventionClassTypeId]) REFERENCES [edfi].[InterventionClassType] ([InterventionClassTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionAppropriateGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[InterventionAppropriateGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionAppropriateGradeLevel] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionAppropriateSex]
-- ----------------------------
ALTER TABLE [edfi].[InterventionAppropriateSex] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionAppropriateSex] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionDiagnosis]
-- ----------------------------
ALTER TABLE [edfi].[InterventionDiagnosis] ADD FOREIGN KEY ([DiagnosisDescriptorId]) REFERENCES [edfi].[DiagnosisDescriptor] ([DiagnosisDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionDiagnosis] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionEducationContent]
-- ----------------------------
ALTER TABLE [edfi].[InterventionEducationContent] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionEducationContent] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionInterventionPrescription]
-- ----------------------------
ALTER TABLE [edfi].[InterventionInterventionPrescription] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionInterventionPrescription] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [InterventionPrescriptionEducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionLearningResourceMetadataURI]
-- ----------------------------
ALTER TABLE [edfi].[InterventionLearningResourceMetadataURI] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionMeetingTime]
-- ----------------------------
ALTER TABLE [edfi].[InterventionMeetingTime] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName]) REFERENCES [edfi].[ClassPeriod] ([SchoolId], [ClassPeriodName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionMeetingTime] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPopulationServed]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPopulationServed] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPopulationServed] ADD FOREIGN KEY ([PopulationServedTypeId]) REFERENCES [edfi].[PopulationServedType] ([PopulationServedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescription]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescription] ADD FOREIGN KEY ([DeliveryMethodTypeId]) REFERENCES [edfi].[DeliveryMethodType] ([DeliveryMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescription] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescription] ADD FOREIGN KEY ([InterventionClassTypeId]) REFERENCES [edfi].[InterventionClassType] ([InterventionClassTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionAppropriateGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionAppropriateGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescriptionAppropriateGradeLevel] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionAppropriateSex]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionAppropriateSex] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescriptionAppropriateSex] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionDiagnosis]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionDiagnosis] ADD FOREIGN KEY ([DiagnosisDescriptorId]) REFERENCES [edfi].[DiagnosisDescriptor] ([DiagnosisDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescriptionDiagnosis] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionEducationContent]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionEducationContent] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescriptionEducationContent] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionLearningResourceMetadataURI]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionLearningResourceMetadataURI] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionPopulationServed]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionPopulationServed] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionPrescriptionPopulationServed] ADD FOREIGN KEY ([PopulationServedTypeId]) REFERENCES [edfi].[PopulationServedType] ([PopulationServedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionPrescriptionURI]
-- ----------------------------
ALTER TABLE [edfi].[InterventionPrescriptionURI] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStaff]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStaff] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStaff] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudy]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudy] ADD FOREIGN KEY ([DeliveryMethodTypeId]) REFERENCES [edfi].[DeliveryMethodType] ([DeliveryMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudy] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudy] ADD FOREIGN KEY ([InterventionClassTypeId]) REFERENCES [edfi].[InterventionClassType] ([InterventionClassTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudy] ADD FOREIGN KEY ([InterventionPrescriptionIdentificationCode], [InterventionPrescriptionEducationOrganizationId]) REFERENCES [edfi].[InterventionPrescription] ([InterventionPrescriptionIdentificationCode], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyAppropriateGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyAppropriateGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyAppropriateGradeLevel] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyAppropriateSex]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyAppropriateSex] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyAppropriateSex] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyEducationContent]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyEducationContent] ADD FOREIGN KEY ([ContentIdentifier]) REFERENCES [edfi].[EducationContent] ([ContentIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyEducationContent] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyInterventionEffectiveness]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyInterventionEffectiveness] ADD FOREIGN KEY ([DiagnosisDescriptorId]) REFERENCES [edfi].[DiagnosisDescriptor] ([DiagnosisDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyInterventionEffectiveness] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyInterventionEffectiveness] ADD FOREIGN KEY ([InterventionEffectivenessRatingTypeId]) REFERENCES [edfi].[InterventionEffectivenessRatingType] ([InterventionEffectivenessRatingTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyInterventionEffectiveness] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyInterventionEffectiveness] ADD FOREIGN KEY ([PopulationServedTypeId]) REFERENCES [edfi].[PopulationServedType] ([PopulationServedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyLearningResourceMetadataURI]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyLearningResourceMetadataURI] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyPopulationServed]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyPopulationServed] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyPopulationServed] ADD FOREIGN KEY ([PopulationServedTypeId]) REFERENCES [edfi].[PopulationServedType] ([PopulationServedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyStateAbbreviation]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyStateAbbreviation] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[InterventionStudyStateAbbreviation] ADD FOREIGN KEY ([StateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionStudyURI]
-- ----------------------------
ALTER TABLE [edfi].[InterventionStudyURI] ADD FOREIGN KEY ([InterventionStudyIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[InterventionStudy] ([InterventionStudyIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[InterventionURI]
-- ----------------------------
ALTER TABLE [edfi].[InterventionURI] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LanguageDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[LanguageDescriptor] ADD FOREIGN KEY ([LanguageDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LanguageDescriptor] ADD FOREIGN KEY ([LanguageTypeId]) REFERENCES [edfi].[LanguageType] ([LanguageTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[LearningObjective] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningObjective] ADD FOREIGN KEY ([ParentObjective], [ParentAcademicSubjectDescriptorId], [ParentObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningObjective] ADD FOREIGN KEY ([ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningObjectiveContentStandard]
-- ----------------------------
ALTER TABLE [edfi].[LearningObjectiveContentStandard] ADD FOREIGN KEY ([MandatingEducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningObjectiveContentStandard] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningObjectiveContentStandard] ADD FOREIGN KEY ([PublicationStatusTypeId]) REFERENCES [edfi].[PublicationStatusType] ([PublicationStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningObjectiveContentStandardAuthor]
-- ----------------------------
ALTER TABLE [edfi].[LearningObjectiveContentStandardAuthor] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjectiveContentStandard] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningObjectiveLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[LearningObjectiveLearningStandard] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningObjectiveLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[LearningStandard] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningStandard] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningStandard] ADD FOREIGN KEY ([ParentLearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningStandardContentStandard]
-- ----------------------------
ALTER TABLE [edfi].[LearningStandardContentStandard] ADD FOREIGN KEY ([MandatingEducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningStandardContentStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningStandardContentStandard] ADD FOREIGN KEY ([PublicationStatusTypeId]) REFERENCES [edfi].[PublicationStatusType] ([PublicationStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningStandardContentStandardAuthor]
-- ----------------------------
ALTER TABLE [edfi].[LearningStandardContentStandardAuthor] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandardContentStandard] ([LearningStandardId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningStandardIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[LearningStandardIdentificationCode] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LearningStandardPrerequisiteLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[LearningStandardPrerequisiteLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LearningStandardPrerequisiteLearningStandard] ADD FOREIGN KEY ([PrerequisiteLearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LeaveEvent]
-- ----------------------------
ALTER TABLE [edfi].[LeaveEvent] ADD FOREIGN KEY ([LeaveEventCategoryTypeId]) REFERENCES [edfi].[LeaveEventCategoryType] ([LeaveEventCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LeaveEvent] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LevelDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[LevelDescriptor] ADD FOREIGN KEY ([LevelDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LevelDescriptorGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[LevelDescriptorGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LevelDescriptorGradeLevel] ADD FOREIGN KEY ([LevelDescriptorId]) REFERENCES [edfi].[LevelDescriptor] ([LevelDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LevelOfEducationDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[LevelOfEducationDescriptor] ADD FOREIGN KEY ([LevelOfEducationDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LevelOfEducationDescriptor] ADD FOREIGN KEY ([LevelOfEducationTypeId]) REFERENCES [edfi].[LevelOfEducationType] ([LevelOfEducationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LimitedEnglishProficiencyDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[LimitedEnglishProficiencyDescriptor] ADD FOREIGN KEY ([LimitedEnglishProficiencyDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LimitedEnglishProficiencyDescriptor] ADD FOREIGN KEY ([LimitedEnglishProficiencyTypeId]) REFERENCES [edfi].[LimitedEnglishProficiencyType] ([LimitedEnglishProficiencyTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LocalEducationAgency]
-- ----------------------------
ALTER TABLE [edfi].[LocalEducationAgency] ADD FOREIGN KEY ([CharterStatusTypeId]) REFERENCES [edfi].[CharterStatusType] ([CharterStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgency] ADD FOREIGN KEY ([LocalEducationAgencyId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgency] ADD FOREIGN KEY ([EducationServiceCenterId]) REFERENCES [edfi].[EducationServiceCenter] ([EducationServiceCenterId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgency] ADD FOREIGN KEY ([ParentLocalEducationAgencyId]) REFERENCES [edfi].[LocalEducationAgency] ([LocalEducationAgencyId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgency] ADD FOREIGN KEY ([LocalEducationAgencyCategoryTypeId]) REFERENCES [edfi].[LocalEducationAgencyCategoryType] ([LocalEducationAgencyCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgency] ADD FOREIGN KEY ([StateEducationAgencyId]) REFERENCES [edfi].[StateEducationAgency] ([StateEducationAgencyId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LocalEducationAgencyAccountability]
-- ----------------------------
ALTER TABLE [edfi].[LocalEducationAgencyAccountability] ADD FOREIGN KEY ([GunFreeSchoolsActReportingStatusTypeId]) REFERENCES [edfi].[GunFreeSchoolsActReportingStatusType] ([GunFreeSchoolsActReportingStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgencyAccountability] ADD FOREIGN KEY ([LocalEducationAgencyId]) REFERENCES [edfi].[LocalEducationAgency] ([LocalEducationAgencyId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgencyAccountability] ADD FOREIGN KEY ([SchoolChoiceImplementStatusTypeId]) REFERENCES [edfi].[SchoolChoiceImplementStatusType] ([SchoolChoiceImplementStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[LocalEducationAgencyAccountability] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[LocalEducationAgencyFederalFunds]
-- ----------------------------
ALTER TABLE [edfi].[LocalEducationAgencyFederalFunds] ADD FOREIGN KEY ([LocalEducationAgencyId]) REFERENCES [edfi].[LocalEducationAgency] ([LocalEducationAgencyId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Location]
-- ----------------------------
ALTER TABLE [edfi].[Location] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ObjectiveAssessment]
-- ----------------------------
ALTER TABLE [edfi].[ObjectiveAssessment] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessment] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [ParentIdentificationCode]) REFERENCES [edfi].[ObjectiveAssessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ObjectiveAssessmentAssessmentItem]
-- ----------------------------
ALTER TABLE [edfi].[ObjectiveAssessmentAssessmentItem] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AssessmentItemIdentificationCode]) REFERENCES [edfi].[AssessmentItem] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessmentAssessmentItem] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[ObjectiveAssessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ObjectiveAssessmentLearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[ObjectiveAssessmentLearningObjective] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessmentLearningObjective] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[ObjectiveAssessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ObjectiveAssessmentLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[ObjectiveAssessmentLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessmentLearningStandard] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[ObjectiveAssessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ObjectiveAssessmentPerformanceLevel]
-- ----------------------------
ALTER TABLE [edfi].[ObjectiveAssessmentPerformanceLevel] ADD FOREIGN KEY ([AssessmentReportingMethodTypeId]) REFERENCES [edfi].[AssessmentReportingMethodType] ([AssessmentReportingMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessmentPerformanceLevel] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[ObjectiveAssessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessmentPerformanceLevel] ADD FOREIGN KEY ([PerformanceLevelDescriptorId]) REFERENCES [edfi].[PerformanceLevelDescriptor] ([PerformanceLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ObjectiveAssessmentPerformanceLevel] ADD FOREIGN KEY ([ResultDatatypeTypeId]) REFERENCES [edfi].[ResultDatatypeType] ([ResultDatatypeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[OpenStaffPosition]
-- ----------------------------
ALTER TABLE [edfi].[OpenStaffPosition] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[OpenStaffPosition] ADD FOREIGN KEY ([EmploymentStatusDescriptorId]) REFERENCES [edfi].[EmploymentStatusDescriptor] ([EmploymentStatusDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[OpenStaffPosition] ADD FOREIGN KEY ([PostingResultTypeId]) REFERENCES [edfi].[PostingResultType] ([PostingResultTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[OpenStaffPosition] ADD FOREIGN KEY ([ProgramAssignmentDescriptorId]) REFERENCES [edfi].[ProgramAssignmentDescriptor] ([ProgramAssignmentDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[OpenStaffPosition] ADD FOREIGN KEY ([StaffClassificationDescriptorId]) REFERENCES [edfi].[StaffClassificationDescriptor] ([StaffClassificationDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[OpenStaffPositionAcademicSubject]
-- ----------------------------
ALTER TABLE [edfi].[OpenStaffPositionAcademicSubject] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[OpenStaffPositionAcademicSubject] ADD FOREIGN KEY ([EducationOrganizationId], [EmploymentStatusDescriptorId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted]) REFERENCES [edfi].[OpenStaffPosition] ([EducationOrganizationId], [EmploymentStatusDescriptorId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[OpenStaffPositionInstructionalGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[OpenStaffPositionInstructionalGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[OpenStaffPositionInstructionalGradeLevel] ADD FOREIGN KEY ([EducationOrganizationId], [EmploymentStatusDescriptorId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted]) REFERENCES [edfi].[OpenStaffPosition] ([EducationOrganizationId], [EmploymentStatusDescriptorId], [StaffClassificationDescriptorId], [RequisitionNumber], [DatePosted]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Parent]
-- ----------------------------
ALTER TABLE [edfi].[Parent] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ParentAddress]
-- ----------------------------
ALTER TABLE [edfi].[ParentAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentAddress] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentAddress] ADD FOREIGN KEY ([StateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ParentElectronicMail]
-- ----------------------------
ALTER TABLE [edfi].[ParentElectronicMail] ADD FOREIGN KEY ([ElectronicMailTypeId]) REFERENCES [edfi].[ElectronicMailType] ([ElectronicMailTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentElectronicMail] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ParentIdentificationDocument]
-- ----------------------------
ALTER TABLE [edfi].[ParentIdentificationDocument] ADD FOREIGN KEY ([IssuerCountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentIdentificationDocument] ADD FOREIGN KEY ([IdentificationDocumentUseTypeId]) REFERENCES [edfi].[IdentificationDocumentUseType] ([IdentificationDocumentUseTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentIdentificationDocument] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentIdentificationDocument] ADD FOREIGN KEY ([PersonalInformationVerificationTypeId]) REFERENCES [edfi].[PersonalInformationVerificationType] ([PersonalInformationVerificationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ParentInternationalAddress]
-- ----------------------------
ALTER TABLE [edfi].[ParentInternationalAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentInternationalAddress] ADD FOREIGN KEY ([CountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentInternationalAddress] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ParentOtherName]
-- ----------------------------
ALTER TABLE [edfi].[ParentOtherName] ADD FOREIGN KEY ([OtherNameTypeId]) REFERENCES [edfi].[OtherNameType] ([OtherNameTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentOtherName] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ParentTelephone]
-- ----------------------------
ALTER TABLE [edfi].[ParentTelephone] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ParentTelephone] ADD FOREIGN KEY ([TelephoneNumberTypeId]) REFERENCES [edfi].[TelephoneNumberType] ([TelephoneNumberTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Payroll]
-- ----------------------------
ALTER TABLE [edfi].[Payroll] ADD FOREIGN KEY ([EducationOrganizationId], [AccountNumber], [FiscalYear]) REFERENCES [edfi].[Account] ([EducationOrganizationId], [AccountNumber], [FiscalYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Payroll] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[PerformanceLevelDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[PerformanceLevelDescriptor] ADD FOREIGN KEY ([PerformanceLevelDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[PerformanceLevelDescriptor] ADD FOREIGN KEY ([PerformanceBaseConversionTypeId]) REFERENCES [edfi].[PerformanceBaseConversionType] ([PerformanceBaseConversionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[PostSecondaryEvent]
-- ----------------------------
ALTER TABLE [edfi].[PostSecondaryEvent] ADD FOREIGN KEY ([PostSecondaryEventCategoryTypeId]) REFERENCES [edfi].[PostSecondaryEventCategoryType] ([PostSecondaryEventCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[PostSecondaryEvent] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[PostSecondaryEventPostSecondaryInstitution]
-- ----------------------------
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitution] ADD FOREIGN KEY ([AdministrativeFundingControlDescriptorId]) REFERENCES [edfi].[AdministrativeFundingControlDescriptor] ([AdministrativeFundingControlDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitution] ADD FOREIGN KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate]) REFERENCES [edfi].[PostSecondaryEvent] ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitution] ADD FOREIGN KEY ([PostSecondaryInstitutionLevelTypeId]) REFERENCES [edfi].[PostSecondaryInstitutionLevelType] ([PostSecondaryInstitutionLevelTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[PostSecondaryEventPostSecondaryInstitutionIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitutionIdentificationCode] ADD FOREIGN KEY ([EducationOrganizationIdentificationSystemTypeId]) REFERENCES [edfi].[EducationOrganizationIdentificationSystemType] ([EducationOrganizationIdentificationSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitutionIdentificationCode] ADD FOREIGN KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate]) REFERENCES [edfi].[PostSecondaryEventPostSecondaryInstitution] ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction]
-- ----------------------------
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction] ADD FOREIGN KEY ([MediumOfInstructionTypeId]) REFERENCES [edfi].[MediumOfInstructionType] ([MediumOfInstructionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[PostSecondaryEventPostSecondaryInstitutionMediumOfInstruction] ADD FOREIGN KEY ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate]) REFERENCES [edfi].[PostSecondaryEventPostSecondaryInstitution] ([StudentUSI], [PostSecondaryEventCategoryTypeId], [EventDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Program]
-- ----------------------------
ALTER TABLE [edfi].[Program] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Program] ADD FOREIGN KEY ([ProgramSponsorTypeId]) REFERENCES [edfi].[ProgramSponsorType] ([ProgramSponsorTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Program] ADD FOREIGN KEY ([ProgramTypeId]) REFERENCES [edfi].[ProgramType] ([ProgramTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ProgramAssignmentDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ProgramAssignmentDescriptor] ADD FOREIGN KEY ([ProgramAssignmentDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ProgramAssignmentDescriptor] ADD FOREIGN KEY ([ProgramAssignmentTypeId]) REFERENCES [edfi].[ProgramAssignmentType] ([ProgramAssignmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ProgramCharacteristic]
-- ----------------------------
ALTER TABLE [edfi].[ProgramCharacteristic] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ProgramCharacteristic] ADD FOREIGN KEY ([ProgramCharacteristicDescriptorId]) REFERENCES [edfi].[ProgramCharacteristicDescriptor] ([ProgramCharacteristicDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ProgramCharacteristicDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ProgramCharacteristicDescriptor] ADD FOREIGN KEY ([ProgramCharacteristicDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ProgramCharacteristicDescriptor] ADD FOREIGN KEY ([ProgramCharacteristicTypeId]) REFERENCES [edfi].[ProgramCharacteristicType] ([ProgramCharacteristicTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ProgramLearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[ProgramLearningObjective] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ProgramLearningObjective] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ProgramLearningStandard]
-- ----------------------------
ALTER TABLE [edfi].[ProgramLearningStandard] ADD FOREIGN KEY ([LearningStandardId]) REFERENCES [edfi].[LearningStandard] ([LearningStandardId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ProgramLearningStandard] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ProgramService]
-- ----------------------------
ALTER TABLE [edfi].[ProgramService] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ProgramService] ADD FOREIGN KEY ([ServiceDescriptorId]) REFERENCES [edfi].[ServiceDescriptor] ([ServiceDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ReasonExitedDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ReasonExitedDescriptor] ADD FOREIGN KEY ([ReasonExitedDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ReasonExitedDescriptor] ADD FOREIGN KEY ([ReasonExitedTypeId]) REFERENCES [edfi].[ReasonExitedType] ([ReasonExitedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ReportCard]
-- ----------------------------
ALTER TABLE [edfi].[ReportCard] ADD FOREIGN KEY ([GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[GradingPeriod] ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ReportCard] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ReportCardGrade]
-- ----------------------------
ALTER TABLE [edfi].[ReportCardGrade] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [GradingPeriodEducationOrganizationId], [GradeTypeId]) REFERENCES [edfi].[Grade] ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [GradingPeriodEducationOrganizationId], [GradeTypeId]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[ReportCardGrade] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[ReportCard] ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ReportCardStudentCompetencyObjective]
-- ----------------------------
ALTER TABLE [edfi].[ReportCardStudentCompetencyObjective] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[ReportCard] ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ReportCardStudentCompetencyObjective] ADD FOREIGN KEY ([StudentUSI], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [ObjectiveGradeLevelDescriptorId], [EducationOrganizationId]) REFERENCES [edfi].[StudentCompetencyObjective] ([StudentUSI], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [ObjectiveGradeLevelDescriptorId], [ObjectiveEducationOrganizationId]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ReportCardStudentLearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[ReportCardStudentLearningObjective] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[ReportCard] ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ReportCardStudentLearningObjective] ADD FOREIGN KEY ([StudentUSI], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[StudentLearningObjective] ([StudentUSI], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate], [Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ReporterDescriptionDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ReporterDescriptionDescriptor] ADD FOREIGN KEY ([ReporterDescriptionDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ReporterDescriptionDescriptor] ADD FOREIGN KEY ([ReporterDescriptionTypeId]) REFERENCES [edfi].[ReporterDescriptionType] ([ReporterDescriptionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ResidencyStatusDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ResidencyStatusDescriptor] ADD FOREIGN KEY ([ResidencyStatusDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ResidencyStatusDescriptor] ADD FOREIGN KEY ([ResidencyStatusTypeId]) REFERENCES [edfi].[ResidencyStatusType] ([ResidencyStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ResponsibilityDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ResponsibilityDescriptor] ADD FOREIGN KEY ([ResponsibilityDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[ResponsibilityDescriptor] ADD FOREIGN KEY ([ResponsibilityTypeId]) REFERENCES [edfi].[ResponsibilityType] ([ResponsibilityTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[RestraintEvent]
-- ----------------------------
ALTER TABLE [edfi].[RestraintEvent] ADD FOREIGN KEY ([EducationalEnvironmentTypeId]) REFERENCES [edfi].[EducationalEnvironmentType] ([EducationalEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[RestraintEvent] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[RestraintEvent] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[RestraintEventProgram]
-- ----------------------------
ALTER TABLE [edfi].[RestraintEventProgram] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[RestraintEventProgram] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate]) REFERENCES [edfi].[RestraintEvent] ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[RestraintEventReason]
-- ----------------------------
ALTER TABLE [edfi].[RestraintEventReason] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate]) REFERENCES [edfi].[RestraintEvent] ([StudentUSI], [SchoolId], [RestraintEventIdentifier], [EventDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[RestraintEventReason] ADD FOREIGN KEY ([RestraintEventReasonTypeId]) REFERENCES [edfi].[RestraintEventReasonType] ([RestraintEventReasonTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[School]
-- ----------------------------
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([AdministrativeFundingControlDescriptorId]) REFERENCES [edfi].[AdministrativeFundingControlDescriptor] ([AdministrativeFundingControlDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([CharterStatusTypeId]) REFERENCES [edfi].[CharterStatusType] ([CharterStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([InternetAccessTypeId]) REFERENCES [edfi].[InternetAccessType] ([InternetAccessTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([LocalEducationAgencyId]) REFERENCES [edfi].[LocalEducationAgency] ([LocalEducationAgencyId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([MagnetSpecialProgramEmphasisSchoolTypeId]) REFERENCES [edfi].[MagnetSpecialProgramEmphasisSchoolType] ([MagnetSpecialProgramEmphasisSchoolTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([SchoolTypeId]) REFERENCES [edfi].[SchoolType] ([SchoolTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[School] ADD FOREIGN KEY ([TitleIPartASchoolDesignationTypeId]) REFERENCES [edfi].[TitleIPartASchoolDesignationType] ([TitleIPartASchoolDesignationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SchoolCategory]
-- ----------------------------
ALTER TABLE [edfi].[SchoolCategory] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SchoolCategory] ADD FOREIGN KEY ([SchoolCategoryTypeId]) REFERENCES [edfi].[SchoolCategoryType] ([SchoolCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SchoolFoodServicesEligibilityDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[SchoolFoodServicesEligibilityDescriptor] ADD FOREIGN KEY ([SchoolFoodServicesEligibilityDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SchoolFoodServicesEligibilityDescriptor] ADD FOREIGN KEY ([SchoolFoodServicesEligibilityTypeId]) REFERENCES [edfi].[SchoolFoodServicesEligibilityType] ([SchoolFoodServicesEligibilityTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SchoolGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[SchoolGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SchoolGradeLevel] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Section]
-- ----------------------------
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName]) REFERENCES [edfi].[ClassPeriod] ([SchoolId], [ClassPeriodName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear], [LocalCourseCode]) REFERENCES [edfi].[CourseOffering] ([SchoolId], [TermTypeId], [SchoolYear], [LocalCourseCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([AvailableCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([EducationalEnvironmentTypeId]) REFERENCES [edfi].[EducationalEnvironmentType] ([EducationalEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([InstructionLanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([SchoolId], [ClassroomIdentificationCode]) REFERENCES [edfi].[Location] ([SchoolId], [ClassroomIdentificationCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([MediumOfInstructionTypeId]) REFERENCES [edfi].[MediumOfInstructionType] ([MediumOfInstructionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([PopulationServedTypeId]) REFERENCES [edfi].[PopulationServedType] ([PopulationServedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Section] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Session] ([SchoolId], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SectionAttendanceTakenEvent]
-- ----------------------------
ALTER TABLE [edfi].[SectionAttendanceTakenEvent] ADD FOREIGN KEY ([SchoolId], [Date]) REFERENCES [edfi].[CalendarDate] ([EducationOrganizationId], [Date]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SectionAttendanceTakenEvent] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[SectionAttendanceTakenEvent] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SectionCharacteristic]
-- ----------------------------
ALTER TABLE [edfi].[SectionCharacteristic] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE CASCADE ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[SectionCharacteristic] ADD FOREIGN KEY ([SectionCharacteristicDescriptorId]) REFERENCES [edfi].[SectionCharacteristicDescriptor] ([SectionCharacteristicDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SectionCharacteristicDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[SectionCharacteristicDescriptor] ADD FOREIGN KEY ([SectionCharacteristicDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SectionCharacteristicDescriptor] ADD FOREIGN KEY ([SectionCharacteristicTypeId]) REFERENCES [edfi].[SectionCharacteristicType] ([SectionCharacteristicTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SectionProgram]
-- ----------------------------
ALTER TABLE [edfi].[SectionProgram] ADD FOREIGN KEY ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SectionProgram] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE CASCADE ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SeparationReasonDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[SeparationReasonDescriptor] ADD FOREIGN KEY ([SeparationReasonDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SeparationReasonDescriptor] ADD FOREIGN KEY ([SeparationReasonTypeId]) REFERENCES [edfi].[SeparationReasonType] ([SeparationReasonTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[ServiceDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[ServiceDescriptor] ADD FOREIGN KEY ([ServiceDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Session]
-- ----------------------------
ALTER TABLE [edfi].[Session] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Session] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Session] ADD FOREIGN KEY ([TermTypeId]) REFERENCES [edfi].[TermType] ([TermTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SessionAcademicWeek]
-- ----------------------------
ALTER TABLE [edfi].[SessionAcademicWeek] ADD FOREIGN KEY ([WeekIdentifier], [EducationOrganizationId]) REFERENCES [edfi].[AcademicWeek] ([WeekIdentifier], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SessionAcademicWeek] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Session] ([SchoolId], [TermTypeId], [SchoolYear]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SessionGradingPeriod]
-- ----------------------------
ALTER TABLE [edfi].[SessionGradingPeriod] ADD FOREIGN KEY ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) REFERENCES [edfi].[GradingPeriod] ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SessionGradingPeriod] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Session] ([SchoolId], [TermTypeId], [SchoolYear]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[SpecialEducationSettingDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[SpecialEducationSettingDescriptor] ADD FOREIGN KEY ([SpecialEducationSettingDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[SpecialEducationSettingDescriptor] ADD FOREIGN KEY ([SpecialEducationSettingTypeId]) REFERENCES [edfi].[SpecialEducationSettingType] ([SpecialEducationSettingTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Staff]
-- ----------------------------
ALTER TABLE [edfi].[Staff] ADD FOREIGN KEY ([CitizenshipStatusTypeId]) REFERENCES [edfi].[CitizenshipStatusType] ([CitizenshipStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Staff] ADD FOREIGN KEY ([HighestCompletedLevelOfEducationDescriptorId]) REFERENCES [edfi].[LevelOfEducationDescriptor] ([LevelOfEducationDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Staff] ADD FOREIGN KEY ([OldEthnicityTypeId]) REFERENCES [edfi].[OldEthnicityType] ([OldEthnicityTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Staff] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffAddress]
-- ----------------------------
ALTER TABLE [edfi].[StaffAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffAddress] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffAddress] ADD FOREIGN KEY ([StateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffClassificationDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[StaffClassificationDescriptor] ADD FOREIGN KEY ([StaffClassificationDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffClassificationDescriptor] ADD FOREIGN KEY ([StaffClassificationTypeId]) REFERENCES [edfi].[StaffClassificationType] ([StaffClassificationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffCohortAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StaffCohortAssociation] ADD FOREIGN KEY ([EducationOrganizationId], [CohortIdentifier]) REFERENCES [edfi].[Cohort] ([EducationOrganizationId], [CohortIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCohortAssociation] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffCredential]
-- ----------------------------
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([CredentialFieldDescriptorId]) REFERENCES [edfi].[CredentialFieldDescriptor] ([CredentialFieldDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([CredentialTypeId]) REFERENCES [edfi].[CredentialType] ([CredentialTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([LevelDescriptorId]) REFERENCES [edfi].[LevelDescriptor] ([LevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([StateOfIssueStateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([TeachingCredentialBasisTypeId]) REFERENCES [edfi].[TeachingCredentialBasisType] ([TeachingCredentialBasisTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffCredential] ADD FOREIGN KEY ([TeachingCredentialDescriptorId]) REFERENCES [edfi].[TeachingCredentialDescriptor] ([TeachingCredentialDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffEducationOrganizationAssignmentAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StaffEducationOrganizationAssignmentAssociation] ADD FOREIGN KEY ([StaffClassificationDescriptorId]) REFERENCES [edfi].[StaffClassificationDescriptor] ([StaffClassificationDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationAssignmentAssociation] ADD FOREIGN KEY ([StaffUSI], [EmploymentEducationOrganizationId], [EmploymentStatusDescriptorId], [EmploymentHireDate]) REFERENCES [edfi].[StaffEducationOrganizationEmploymentAssociation] ([StaffUSI], [EducationOrganizationId], [EmploymentStatusDescriptorId], [HireDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationAssignmentAssociation] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationAssignmentAssociation] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffEducationOrganizationEmploymentAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StaffEducationOrganizationEmploymentAssociation] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationEmploymentAssociation] ADD FOREIGN KEY ([EmploymentStatusDescriptorId]) REFERENCES [edfi].[EmploymentStatusDescriptor] ([EmploymentStatusDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationEmploymentAssociation] ADD FOREIGN KEY ([SeparationReasonDescriptorId]) REFERENCES [edfi].[SeparationReasonDescriptor] ([SeparationReasonDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationEmploymentAssociation] ADD FOREIGN KEY ([SeparationTypeId]) REFERENCES [edfi].[SeparationType] ([SeparationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffEducationOrganizationEmploymentAssociation] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffElectronicMail]
-- ----------------------------
ALTER TABLE [edfi].[StaffElectronicMail] ADD FOREIGN KEY ([ElectronicMailTypeId]) REFERENCES [edfi].[ElectronicMailType] ([ElectronicMailTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffElectronicMail] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[StaffIdentificationCode] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffIdentificationCode] ADD FOREIGN KEY ([StaffIdentificationSystemTypeId]) REFERENCES [edfi].[StaffIdentificationSystemType] ([StaffIdentificationSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffIdentificationDocument]
-- ----------------------------
ALTER TABLE [edfi].[StaffIdentificationDocument] ADD FOREIGN KEY ([IssuerCountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffIdentificationDocument] ADD FOREIGN KEY ([IdentificationDocumentUseTypeId]) REFERENCES [edfi].[IdentificationDocumentUseType] ([IdentificationDocumentUseTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffIdentificationDocument] ADD FOREIGN KEY ([PersonalInformationVerificationTypeId]) REFERENCES [edfi].[PersonalInformationVerificationType] ([PersonalInformationVerificationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffIdentificationDocument] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffInternationalAddress]
-- ----------------------------
ALTER TABLE [edfi].[StaffInternationalAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffInternationalAddress] ADD FOREIGN KEY ([CountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffInternationalAddress] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffLanguage]
-- ----------------------------
ALTER TABLE [edfi].[StaffLanguage] ADD FOREIGN KEY ([LanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffLanguage] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffLanguageUse]
-- ----------------------------
ALTER TABLE [edfi].[StaffLanguageUse] ADD FOREIGN KEY ([LanguageUseTypeId]) REFERENCES [edfi].[LanguageUseType] ([LanguageUseTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffLanguageUse] ADD FOREIGN KEY ([StaffUSI], [LanguageDescriptorId]) REFERENCES [edfi].[StaffLanguage] ([StaffUSI], [LanguageDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffOtherName]
-- ----------------------------
ALTER TABLE [edfi].[StaffOtherName] ADD FOREIGN KEY ([OtherNameTypeId]) REFERENCES [edfi].[OtherNameType] ([OtherNameTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffOtherName] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffProgramAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StaffProgramAssociation] ADD FOREIGN KEY ([ProgramEducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffProgramAssociation] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffRace]
-- ----------------------------
ALTER TABLE [edfi].[StaffRace] ADD FOREIGN KEY ([RaceTypeId]) REFERENCES [edfi].[RaceType] ([RaceTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffRace] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffSchoolAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StaffSchoolAssociation] ADD FOREIGN KEY ([ProgramAssignmentDescriptorId]) REFERENCES [edfi].[ProgramAssignmentDescriptor] ([ProgramAssignmentDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffSchoolAssociation] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffSchoolAssociation] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffSchoolAssociationAcademicSubject]
-- ----------------------------
ALTER TABLE [edfi].[StaffSchoolAssociationAcademicSubject] ADD FOREIGN KEY ([AcademicSubjectDescriptorId]) REFERENCES [edfi].[AcademicSubjectDescriptor] ([AcademicSubjectDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffSchoolAssociationAcademicSubject] ADD FOREIGN KEY ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId]) REFERENCES [edfi].[StaffSchoolAssociation] ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffSchoolAssociationGradeLevel]
-- ----------------------------
ALTER TABLE [edfi].[StaffSchoolAssociationGradeLevel] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffSchoolAssociationGradeLevel] ADD FOREIGN KEY ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId]) REFERENCES [edfi].[StaffSchoolAssociation] ([StaffUSI], [ProgramAssignmentDescriptorId], [SchoolId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffSectionAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StaffSectionAssociation] ADD FOREIGN KEY ([ClassroomPositionDescriptorId]) REFERENCES [edfi].[ClassroomPositionDescriptor] ([ClassroomPositionDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffSectionAssociation] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[StaffSectionAssociation] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffTelephone]
-- ----------------------------
ALTER TABLE [edfi].[StaffTelephone] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffTelephone] ADD FOREIGN KEY ([TelephoneNumberTypeId]) REFERENCES [edfi].[TelephoneNumberType] ([TelephoneNumberTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StaffVisa]
-- ----------------------------
ALTER TABLE [edfi].[StaffVisa] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StaffVisa] ADD FOREIGN KEY ([VisaTypeId]) REFERENCES [edfi].[VisaType] ([VisaTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StateEducationAgency]
-- ----------------------------
ALTER TABLE [edfi].[StateEducationAgency] ADD FOREIGN KEY ([StateEducationAgencyId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StateEducationAgencyAccountability]
-- ----------------------------
ALTER TABLE [edfi].[StateEducationAgencyAccountability] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StateEducationAgencyAccountability] ADD FOREIGN KEY ([StateEducationAgencyId]) REFERENCES [edfi].[StateEducationAgency] ([StateEducationAgencyId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StateEducationAgencyFederalFunds]
-- ----------------------------
ALTER TABLE [edfi].[StateEducationAgencyFederalFunds] ADD FOREIGN KEY ([StateEducationAgencyId]) REFERENCES [edfi].[StateEducationAgency] ([StateEducationAgencyId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[Student]
-- ----------------------------
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([CitizenshipStatusTypeId]) REFERENCES [edfi].[CitizenshipStatusType] ([CitizenshipStatusTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([BirthCountryCodeTypeId]) REFERENCES [edfi].[CountryCodeType] ([CountryCodeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([LimitedEnglishProficiencyDescriptorId]) REFERENCES [edfi].[LimitedEnglishProficiencyDescriptor] ([LimitedEnglishProficiencyDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([OldEthnicityTypeId]) REFERENCES [edfi].[OldEthnicityType] ([OldEthnicityTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([SchoolFoodServicesEligibilityDescriptorId]) REFERENCES [edfi].[SchoolFoodServicesEligibilityDescriptor] ([SchoolFoodServicesEligibilityDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([SexTypeId]) REFERENCES [edfi].[SexType] ([SexTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[Student] ADD FOREIGN KEY ([BirthStateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAcademicRecord]
-- ----------------------------
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([CumulativeAttemptedCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([CumulativeEarnedCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([SessionAttemptedCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([SessionEarnedCreditTypeId]) REFERENCES [edfi].[CreditType] ([CreditTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecord] ADD FOREIGN KEY ([TermTypeId]) REFERENCES [edfi].[TermType] ([TermTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAcademicRecordAcademicHonor]
-- ----------------------------
ALTER TABLE [edfi].[StudentAcademicRecordAcademicHonor] ADD FOREIGN KEY ([AcademicHonorCategoryTypeId]) REFERENCES [edfi].[AcademicHonorCategoryType] ([AcademicHonorCategoryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordAcademicHonor] ADD FOREIGN KEY ([AchievementCategoryDescriptorId]) REFERENCES [edfi].[AchievementCategoryDescriptor] ([AchievementCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordAcademicHonor] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) REFERENCES [edfi].[StudentAcademicRecord] ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAcademicRecordClassRanking]
-- ----------------------------
ALTER TABLE [edfi].[StudentAcademicRecordClassRanking] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) REFERENCES [edfi].[StudentAcademicRecord] ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAcademicRecordDiploma]
-- ----------------------------
ALTER TABLE [edfi].[StudentAcademicRecordDiploma] ADD FOREIGN KEY ([AchievementCategoryDescriptorId]) REFERENCES [edfi].[AchievementCategoryDescriptor] ([AchievementCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordDiploma] ADD FOREIGN KEY ([DiplomaLevelTypeId]) REFERENCES [edfi].[DiplomaLevelType] ([DiplomaLevelTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordDiploma] ADD FOREIGN KEY ([DiplomaTypeId]) REFERENCES [edfi].[DiplomaType] ([DiplomaTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordDiploma] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) REFERENCES [edfi].[StudentAcademicRecord] ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAcademicRecordRecognition]
-- ----------------------------
ALTER TABLE [edfi].[StudentAcademicRecordRecognition] ADD FOREIGN KEY ([AchievementCategoryDescriptorId]) REFERENCES [edfi].[AchievementCategoryDescriptor] ([AchievementCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordRecognition] ADD FOREIGN KEY ([RecognitionTypeId]) REFERENCES [edfi].[RecognitionType] ([RecognitionTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordRecognition] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) REFERENCES [edfi].[StudentAcademicRecord] ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAcademicRecordReportCard]
-- ----------------------------
ALTER TABLE [edfi].[StudentAcademicRecordReportCard] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[ReportCard] ([StudentUSI], [EducationOrganizationId], [GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAcademicRecordReportCard] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) REFERENCES [edfi].[StudentAcademicRecord] ([StudentUSI], [EducationOrganizationId], [SchoolYear], [TermTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAddress]
-- ----------------------------
ALTER TABLE [edfi].[StudentAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAddress] ADD FOREIGN KEY ([StateAbbreviationTypeId]) REFERENCES [edfi].[StateAbbreviationType] ([StateAbbreviationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAddress] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessment]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([AdministrationEnvironmentTypeId]) REFERENCES [edfi].[AdministrationEnvironmentType] ([AdministrationEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) REFERENCES [edfi].[Assessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([EventCircumstanceTypeId]) REFERENCES [edfi].[EventCircumstanceType] ([EventCircumstanceTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([AdministrationLanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([ReasonNotTestedTypeId]) REFERENCES [edfi].[ReasonNotTestedType] ([ReasonNotTestedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([RetestIndicatorTypeId]) REFERENCES [edfi].[RetestIndicatorType] ([RetestIndicatorTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessment] ADD FOREIGN KEY ([WhenAssessedGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentAccommodation]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentAccommodation] ADD FOREIGN KEY ([AccommodationDescriptorId]) REFERENCES [edfi].[AccommodationDescriptor] ([AccommodationDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentAccommodation] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) REFERENCES [edfi].[StudentAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentItem]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentItem] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[AssessmentItem] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentItem] ADD FOREIGN KEY ([AssessmentItemResultTypeId]) REFERENCES [edfi].[AssessmentItemResultType] ([AssessmentItemResultTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentItem] ADD FOREIGN KEY ([ResponseIndicatorTypeId]) REFERENCES [edfi].[ResponseIndicatorType] ([ResponseIndicatorTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentItem] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) REFERENCES [edfi].[StudentAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentPerformanceLevel]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentPerformanceLevel] ADD FOREIGN KEY ([PerformanceLevelDescriptorId]) REFERENCES [edfi].[PerformanceLevelDescriptor] ([PerformanceLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentPerformanceLevel] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) REFERENCES [edfi].[StudentAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentScoreResult]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentScoreResult] ADD FOREIGN KEY ([AssessmentReportingMethodTypeId]) REFERENCES [edfi].[AssessmentReportingMethodType] ([AssessmentReportingMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentScoreResult] ADD FOREIGN KEY ([ResultDatatypeTypeId]) REFERENCES [edfi].[ResultDatatypeType] ([ResultDatatypeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentScoreResult] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) REFERENCES [edfi].[StudentAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentStudentObjectiveAssessment]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessment] ADD FOREIGN KEY ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) REFERENCES [edfi].[ObjectiveAssessment] ([AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessment] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) REFERENCES [edfi].[StudentAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentStudentObjectiveAssessmentPerformanceLevel]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentPerformanceLevel] ADD FOREIGN KEY ([PerformanceLevelDescriptorId]) REFERENCES [edfi].[PerformanceLevelDescriptor] ([PerformanceLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentPerformanceLevel] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate]) REFERENCES [edfi].[StudentAssessmentStudentObjectiveAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentAssessmentStudentObjectiveAssessmentScoreResult]
-- ----------------------------
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentScoreResult] ADD FOREIGN KEY ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate]) REFERENCES [edfi].[StudentAssessmentStudentObjectiveAssessment] ([StudentUSI], [AssessmentTitle], [AcademicSubjectDescriptorId], [AssessedGradeLevelDescriptorId], [Version], [IdentificationCode], [AdministrationDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentScoreResult] ADD FOREIGN KEY ([AssessmentReportingMethodTypeId]) REFERENCES [edfi].[AssessmentReportingMethodType] ([AssessmentReportingMethodTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentAssessmentStudentObjectiveAssessmentScoreResult] ADD FOREIGN KEY ([ResultDatatypeTypeId]) REFERENCES [edfi].[ResultDatatypeType] ([ResultDatatypeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCharacteristic]
-- ----------------------------
ALTER TABLE [edfi].[StudentCharacteristic] ADD FOREIGN KEY ([StudentCharacteristicDescriptorId]) REFERENCES [edfi].[StudentCharacteristicDescriptor] ([StudentCharacteristicDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCharacteristic] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCharacteristicDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[StudentCharacteristicDescriptor] ADD FOREIGN KEY ([StudentCharacteristicDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCharacteristicDescriptor] ADD FOREIGN KEY ([StudentCharacteristicTypeId]) REFERENCES [edfi].[StudentCharacteristicType] ([StudentCharacteristicTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCohortAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentCohortAssociation] ADD FOREIGN KEY ([EducationOrganizationId], [CohortIdentifier]) REFERENCES [edfi].[Cohort] ([EducationOrganizationId], [CohortIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCohortAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCohortAssociationSection]
-- ----------------------------
ALTER TABLE [edfi].[StudentCohortAssociationSection] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[StudentCohortAssociationSection] ADD FOREIGN KEY ([StudentUSI], [EducationOrganizationId], [CohortIdentifier], [BeginDate]) REFERENCES [edfi].[StudentCohortAssociation] ([StudentUSI], [EducationOrganizationId], [CohortIdentifier], [BeginDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCohortYear]
-- ----------------------------
ALTER TABLE [edfi].[StudentCohortYear] ADD FOREIGN KEY ([CohortYearTypeId]) REFERENCES [edfi].[CohortYearType] ([CohortYearTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCohortYear] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCohortYear] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCompetencyObjective]
-- ----------------------------
ALTER TABLE [edfi].[StudentCompetencyObjective] ADD FOREIGN KEY ([CompetencyLevelDescriptorId]) REFERENCES [edfi].[CompetencyLevelDescriptor] ([CompetencyLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCompetencyObjective] ADD FOREIGN KEY ([Objective], [ObjectiveGradeLevelDescriptorId], [ObjectiveEducationOrganizationId]) REFERENCES [edfi].[CompetencyObjective] ([Objective], [ObjectiveGradeLevelDescriptorId], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCompetencyObjective] ADD FOREIGN KEY ([GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[GradingPeriod] ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCompetencyObjective] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCompetencyObjective] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) REFERENCES [edfi].[StudentSectionAssociation] ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCTEProgramAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentCTEProgramAssociation] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentCTEProgramAssociationCTEProgram]
-- ----------------------------
ALTER TABLE [edfi].[StudentCTEProgramAssociationCTEProgram] ADD FOREIGN KEY ([CareerPathwayTypeId]) REFERENCES [edfi].[CareerPathwayType] ([CareerPathwayTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentCTEProgramAssociationCTEProgram] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentCTEProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentDisability]
-- ----------------------------
ALTER TABLE [edfi].[StudentDisability] ADD FOREIGN KEY ([DisabilityDescriptorId]) REFERENCES [edfi].[DisabilityDescriptor] ([DisabilityDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentDisability] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentDisciplineIncidentAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentDisciplineIncidentAssociation] ADD FOREIGN KEY ([SchoolId], [IncidentIdentifier]) REFERENCES [edfi].[DisciplineIncident] ([SchoolId], [IncidentIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentDisciplineIncidentAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentDisciplineIncidentAssociation] ADD FOREIGN KEY ([StudentParticipationCodeTypeId]) REFERENCES [edfi].[StudentParticipationCodeType] ([StudentParticipationCodeTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentDisciplineIncidentAssociationBehavior]
-- ----------------------------
ALTER TABLE [edfi].[StudentDisciplineIncidentAssociationBehavior] ADD FOREIGN KEY ([BehaviorDescriptorId]) REFERENCES [edfi].[BehaviorDescriptor] ([BehaviorDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentDisciplineIncidentAssociationBehavior] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [IncidentIdentifier]) REFERENCES [edfi].[StudentDisciplineIncidentAssociation] ([StudentUSI], [SchoolId], [IncidentIdentifier]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentEducationOrganizationAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentEducationOrganizationAssociation] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentEducationOrganizationAssociation] ADD FOREIGN KEY ([ResponsibilityDescriptorId]) REFERENCES [edfi].[ResponsibilityDescriptor] ([ResponsibilityDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentEducationOrganizationAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentElectronicMail]
-- ----------------------------
ALTER TABLE [edfi].[StudentElectronicMail] ADD FOREIGN KEY ([ElectronicMailTypeId]) REFERENCES [edfi].[ElectronicMailType] ([ElectronicMailTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentElectronicMail] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentGradebookEntry]
-- ----------------------------
ALTER TABLE [edfi].[StudentGradebookEntry] ADD FOREIGN KEY ([CompetencyLevelDescriptorId]) REFERENCES [edfi].[CompetencyLevelDescriptor] ([CompetencyLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentGradebookEntry] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned]) REFERENCES [edfi].[GradebookEntry] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [GradebookEntryTitle], [DateAssigned]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[StudentGradebookEntry] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) REFERENCES [edfi].[StudentSectionAssociation] ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentIdentificationCode]
-- ----------------------------
ALTER TABLE [edfi].[StudentIdentificationCode] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentIdentificationCode] ADD FOREIGN KEY ([StudentIdentificationSystemTypeId]) REFERENCES [edfi].[StudentIdentificationSystemType] ([StudentIdentificationSystemTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentIdentificationDocument]
-- ----------------------------
ALTER TABLE [edfi].[StudentIdentificationDocument] ADD FOREIGN KEY ([IssuerCountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentIdentificationDocument] ADD FOREIGN KEY ([IdentificationDocumentUseTypeId]) REFERENCES [edfi].[IdentificationDocumentUseType] ([IdentificationDocumentUseTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentIdentificationDocument] ADD FOREIGN KEY ([PersonalInformationVerificationTypeId]) REFERENCES [edfi].[PersonalInformationVerificationType] ([PersonalInformationVerificationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentIdentificationDocument] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentIndicator]
-- ----------------------------
ALTER TABLE [edfi].[StudentIndicator] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentInternationalAddress]
-- ----------------------------
ALTER TABLE [edfi].[StudentInternationalAddress] ADD FOREIGN KEY ([AddressTypeId]) REFERENCES [edfi].[AddressType] ([AddressTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInternationalAddress] ADD FOREIGN KEY ([CountryTypeId]) REFERENCES [edfi].[CountryType] ([CountryTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInternationalAddress] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentInterventionAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentInterventionAssociation] ADD FOREIGN KEY ([EducationOrganizationId], [CohortIdentifier]) REFERENCES [edfi].[Cohort] ([EducationOrganizationId], [CohortIdentifier]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAssociation] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentInterventionAssociationInterventionEffectiveness]
-- ----------------------------
ALTER TABLE [edfi].[StudentInterventionAssociationInterventionEffectiveness] ADD FOREIGN KEY ([DiagnosisDescriptorId]) REFERENCES [edfi].[DiagnosisDescriptor] ([DiagnosisDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAssociationInterventionEffectiveness] ADD FOREIGN KEY ([GradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAssociationInterventionEffectiveness] ADD FOREIGN KEY ([InterventionEffectivenessRatingTypeId]) REFERENCES [edfi].[InterventionEffectivenessRatingType] ([InterventionEffectivenessRatingTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAssociationInterventionEffectiveness] ADD FOREIGN KEY ([PopulationServedTypeId]) REFERENCES [edfi].[PopulationServedType] ([PopulationServedTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAssociationInterventionEffectiveness] ADD FOREIGN KEY ([StudentUSI], [InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[StudentInterventionAssociation] ([StudentUSI], [InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentInterventionAttendanceEvent]
-- ----------------------------
ALTER TABLE [edfi].[StudentInterventionAttendanceEvent] ADD FOREIGN KEY ([AttendanceEventCategoryDescriptorId]) REFERENCES [edfi].[AttendanceEventCategoryDescriptor] ([AttendanceEventCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAttendanceEvent] ADD FOREIGN KEY ([EducationalEnvironmentTypeId]) REFERENCES [edfi].[EducationalEnvironmentType] ([EducationalEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAttendanceEvent] ADD FOREIGN KEY ([InterventionIdentificationCode], [EducationOrganizationId]) REFERENCES [edfi].[Intervention] ([InterventionIdentificationCode], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentInterventionAttendanceEvent] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentLanguage]
-- ----------------------------
ALTER TABLE [edfi].[StudentLanguage] ADD FOREIGN KEY ([LanguageDescriptorId]) REFERENCES [edfi].[LanguageDescriptor] ([LanguageDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentLanguage] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentLanguageUse]
-- ----------------------------
ALTER TABLE [edfi].[StudentLanguageUse] ADD FOREIGN KEY ([LanguageUseTypeId]) REFERENCES [edfi].[LanguageUseType] ([LanguageUseTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentLanguageUse] ADD FOREIGN KEY ([StudentUSI], [LanguageDescriptorId]) REFERENCES [edfi].[StudentLanguage] ([StudentUSI], [LanguageDescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentLearningObjective]
-- ----------------------------
ALTER TABLE [edfi].[StudentLearningObjective] ADD FOREIGN KEY ([CompetencyLevelDescriptorId]) REFERENCES [edfi].[CompetencyLevelDescriptor] ([CompetencyLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentLearningObjective] ADD FOREIGN KEY ([GradingPeriodEducationOrganizationId], [GradingPeriodDescriptorId], [GradingPeriodBeginDate]) REFERENCES [edfi].[GradingPeriod] ([EducationOrganizationId], [GradingPeriodDescriptorId], [BeginDate]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentLearningObjective] ADD FOREIGN KEY ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) REFERENCES [edfi].[LearningObjective] ([Objective], [AcademicSubjectDescriptorId], [ObjectiveGradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentLearningObjective] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentLearningObjective] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) REFERENCES [edfi].[StudentSectionAssociation] ([StudentUSI], [SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear], [BeginDate]) ON DELETE NO ACTION ON UPDATE CASCADE
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentLearningStyle]
-- ----------------------------
ALTER TABLE [edfi].[StudentLearningStyle] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentMigrantEducationProgramAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentMigrantEducationProgramAssociation] ADD FOREIGN KEY ([ContinuationOfServicesReasonDescriptorId]) REFERENCES [edfi].[ContinuationOfServicesReasonDescriptor] ([ContinuationOfServicesReasonDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentMigrantEducationProgramAssociation] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentOtherName]
-- ----------------------------
ALTER TABLE [edfi].[StudentOtherName] ADD FOREIGN KEY ([OtherNameTypeId]) REFERENCES [edfi].[OtherNameType] ([OtherNameTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentOtherName] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentParentAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentParentAssociation] ADD FOREIGN KEY ([ParentUSI]) REFERENCES [edfi].[Parent] ([ParentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentParentAssociation] ADD FOREIGN KEY ([RelationTypeId]) REFERENCES [edfi].[RelationType] ([RelationTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentParentAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentProgramAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentProgramAssociation] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAssociation] ADD FOREIGN KEY ([ProgramEducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAssociation] ADD FOREIGN KEY ([ReasonExitedDescriptorId]) REFERENCES [edfi].[ReasonExitedDescriptor] ([ReasonExitedDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentProgramAssociationService]
-- ----------------------------
ALTER TABLE [edfi].[StudentProgramAssociationService] ADD FOREIGN KEY ([ServiceDescriptorId]) REFERENCES [edfi].[ServiceDescriptor] ([ServiceDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAssociationService] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentProgramAttendanceEvent]
-- ----------------------------
ALTER TABLE [edfi].[StudentProgramAttendanceEvent] ADD FOREIGN KEY ([AttendanceEventCategoryDescriptorId]) REFERENCES [edfi].[AttendanceEventCategoryDescriptor] ([AttendanceEventCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAttendanceEvent] ADD FOREIGN KEY ([EducationalEnvironmentTypeId]) REFERENCES [edfi].[EducationalEnvironmentType] ([EducationalEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAttendanceEvent] ADD FOREIGN KEY ([EducationOrganizationId]) REFERENCES [edfi].[EducationOrganization] ([EducationOrganizationId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAttendanceEvent] ADD FOREIGN KEY ([ProgramEducationOrganizationId], [ProgramTypeId], [ProgramName]) REFERENCES [edfi].[Program] ([EducationOrganizationId], [ProgramTypeId], [ProgramName]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramAttendanceEvent] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentProgramParticipation]
-- ----------------------------
ALTER TABLE [edfi].[StudentProgramParticipation] ADD FOREIGN KEY ([ProgramTypeId]) REFERENCES [edfi].[ProgramType] ([ProgramTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramParticipation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentProgramParticipationProgramCharacteristic]
-- ----------------------------
ALTER TABLE [edfi].[StudentProgramParticipationProgramCharacteristic] ADD FOREIGN KEY ([ProgramCharacteristicDescriptorId]) REFERENCES [edfi].[ProgramCharacteristicDescriptor] ([ProgramCharacteristicDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentProgramParticipationProgramCharacteristic] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId]) REFERENCES [edfi].[StudentProgramParticipation] ([StudentUSI], [ProgramTypeId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentRace]
-- ----------------------------
ALTER TABLE [edfi].[StudentRace] ADD FOREIGN KEY ([RaceTypeId]) REFERENCES [edfi].[RaceType] ([RaceTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentRace] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSchoolAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([EntryGradeLevelDescriptorId]) REFERENCES [edfi].[GradeLevelDescriptor] ([GradeLevelDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([EntryGradeLevelReasonTypeId]) REFERENCES [edfi].[EntryGradeLevelReasonType] ([EntryGradeLevelReasonTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([EntryTypeDescriptorId]) REFERENCES [edfi].[EntryTypeDescriptor] ([EntryTypeDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([ExitWithdrawTypeDescriptorId]) REFERENCES [edfi].[ExitWithdrawTypeDescriptor] ([ExitWithdrawTypeDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear]) REFERENCES [edfi].[GraduationPlan] ([EducationOrganizationId], [GraduationPlanTypeDescriptorId], [GraduationSchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([ResidencyStatusDescriptorId]) REFERENCES [edfi].[ResidencyStatusDescriptor] ([ResidencyStatusDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([ClassOfSchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([SchoolYear]) REFERENCES [edfi].[SchoolYearType] ([SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSchoolAssociationEducationPlan]
-- ----------------------------
ALTER TABLE [edfi].[StudentSchoolAssociationEducationPlan] ADD FOREIGN KEY ([EducationPlanTypeId]) REFERENCES [edfi].[EducationPlanType] ([EducationPlanTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAssociationEducationPlan] ADD FOREIGN KEY ([StudentUSI], [SchoolId], [EntryDate]) REFERENCES [edfi].[StudentSchoolAssociation] ([StudentUSI], [SchoolId], [EntryDate]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSchoolAttendanceEvent]
-- ----------------------------
ALTER TABLE [edfi].[StudentSchoolAttendanceEvent] ADD FOREIGN KEY ([AttendanceEventCategoryDescriptorId]) REFERENCES [edfi].[AttendanceEventCategoryDescriptor] ([AttendanceEventCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAttendanceEvent] ADD FOREIGN KEY ([EducationalEnvironmentTypeId]) REFERENCES [edfi].[EducationalEnvironmentType] ([EducationalEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAttendanceEvent] ADD FOREIGN KEY ([SchoolId]) REFERENCES [edfi].[School] ([SchoolId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAttendanceEvent] ADD FOREIGN KEY ([SchoolId], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Session] ([SchoolId], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSchoolAttendanceEvent] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSectionAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentSectionAssociation] ADD FOREIGN KEY ([RepeatIdentifierTypeId]) REFERENCES [edfi].[RepeatIdentifierType] ([RepeatIdentifierTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSectionAssociation] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[StudentSectionAssociation] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSectionAttendanceEvent]
-- ----------------------------
ALTER TABLE [edfi].[StudentSectionAttendanceEvent] ADD FOREIGN KEY ([AttendanceEventCategoryDescriptorId]) REFERENCES [edfi].[AttendanceEventCategoryDescriptor] ([AttendanceEventCategoryDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSectionAttendanceEvent] ADD FOREIGN KEY ([EducationalEnvironmentTypeId]) REFERENCES [edfi].[EducationalEnvironmentType] ([EducationalEnvironmentTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSectionAttendanceEvent] ADD FOREIGN KEY ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) REFERENCES [edfi].[Section] ([SchoolId], [ClassPeriodName], [ClassroomIdentificationCode], [LocalCourseCode], [TermTypeId], [SchoolYear]) ON DELETE NO ACTION ON UPDATE CASCADE
GO
ALTER TABLE [edfi].[StudentSectionAttendanceEvent] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSpecialEducationProgramAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentSpecialEducationProgramAssociation] ADD FOREIGN KEY ([SpecialEducationSettingDescriptorId]) REFERENCES [edfi].[SpecialEducationSettingDescriptor] ([SpecialEducationSettingDescriptorId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSpecialEducationProgramAssociation] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentSpecialEducationProgramAssociationServiceProvider]
-- ----------------------------
ALTER TABLE [edfi].[StudentSpecialEducationProgramAssociationServiceProvider] ADD FOREIGN KEY ([StaffUSI]) REFERENCES [edfi].[Staff] ([StaffUSI]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentSpecialEducationProgramAssociationServiceProvider] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentSpecialEducationProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentTelephone]
-- ----------------------------
ALTER TABLE [edfi].[StudentTelephone] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentTelephone] ADD FOREIGN KEY ([TelephoneNumberTypeId]) REFERENCES [edfi].[TelephoneNumberType] ([TelephoneNumberTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentTitleIPartAProgramAssociation]
-- ----------------------------
ALTER TABLE [edfi].[StudentTitleIPartAProgramAssociation] ADD FOREIGN KEY ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) REFERENCES [edfi].[StudentProgramAssociation] ([StudentUSI], [ProgramTypeId], [ProgramName], [ProgramEducationOrganizationId], [BeginDate], [EducationOrganizationId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentTitleIPartAProgramAssociation] ADD FOREIGN KEY ([TitleIPartAParticipantTypeId]) REFERENCES [edfi].[TitleIPartAParticipantType] ([TitleIPartAParticipantTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[StudentVisa]
-- ----------------------------
ALTER TABLE [edfi].[StudentVisa] ADD FOREIGN KEY ([StudentUSI]) REFERENCES [edfi].[Student] ([StudentUSI]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[StudentVisa] ADD FOREIGN KEY ([VisaTypeId]) REFERENCES [edfi].[VisaType] ([VisaTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[TeachingCredentialDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[TeachingCredentialDescriptor] ADD FOREIGN KEY ([TeachingCredentialDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[TeachingCredentialDescriptor] ADD FOREIGN KEY ([TeachingCredentialTypeId]) REFERENCES [edfi].[TeachingCredentialType] ([TeachingCredentialTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO

-- ----------------------------
-- Foreign Key structure for table [edfi].[WeaponDescriptor]
-- ----------------------------
ALTER TABLE [edfi].[WeaponDescriptor] ADD FOREIGN KEY ([WeaponDescriptorId]) REFERENCES [edfi].[Descriptor] ([DescriptorId]) ON DELETE CASCADE ON UPDATE NO ACTION
GO
ALTER TABLE [edfi].[WeaponDescriptor] ADD FOREIGN KEY ([WeaponTypeId]) REFERENCES [edfi].[WeaponType] ([WeaponTypeId]) ON DELETE NO ACTION ON UPDATE NO ACTION
GO
