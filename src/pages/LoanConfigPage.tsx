import React from 'react';
import { useTranslation } from 'react-i18next';
import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { LoanConfig } from '@app/components/apps/configuration/loan/Loan';

const LoanConfigPage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.loan')}</PageTitle>
      <LoanConfig />
    </>
  );
};

export default LoanConfigPage;
