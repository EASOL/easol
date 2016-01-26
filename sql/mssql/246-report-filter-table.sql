SET QUOTED_IDENTIFIER ON
GO

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

GO

