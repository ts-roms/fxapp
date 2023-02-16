import React from 'react';
import { useTranslation } from 'react-i18next';
import { PageTitle } from '@app/components/common/PageTitle/PageTitle';
import { LoanForm } from '@app/components/apps/configuration/loan-form/LoanForm';

const LoanFormPage: React.FC = () => {
  const { t } = useTranslation();

  return (
    <>
      <PageTitle>{t('common.loanForm')}</PageTitle>
      <LoanForm />
    </>
  );
};

export default LoanFormPage;
