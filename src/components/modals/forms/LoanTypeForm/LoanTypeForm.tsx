import { useState } from 'react';
import { BaseForm } from '@app/components/common/forms/BaseForm/BaseForm';
import * as S from './LoanTypeForm.styles';
import { Button } from '@app/components/common/buttons/Button/Button';
import { mergeBy } from '@app/utils/utils';
import { Col, Divider, Row, Typography } from 'antd';
import { Input, TextArea } from '@app/components/common/inputs/Input/Input';
import { useTranslation } from 'react-i18next';
import { notificationController } from '@app/controllers/notificationController';
import { Spinner } from '@app/components/common/Spinner/Spinner';
import { InputNumber } from '@app/components/common/inputs/InputNumber/InputNumber.styles';

interface ILoanTypeForm {
  open: boolean;
  setOpen: (e: boolean) => void;
}

interface FieldData {
  name: string | number;
  value: any;
}

interface FormValues {
  [key: string]: string | undefined;
}

export const LoanTypeForm: React.FC<ILoanTypeForm> = (
  collectionForm: ILoanTypeForm,
) => {
  const { t } = useTranslation();

  const { open, setOpen } = collectionForm;
  const [isLoading, setIsLoading] = useState(false);
  const [form] = BaseForm.useForm();
  const [fields, setFields] = useState<FieldData[]>([
    { name: 'name', value: '' },
    { name: 'form', value: '' },
    { name: 'principal', value: '' },
    { name: 'terms', value: '' },
    { name: 'repaymentCycle', value: '' },
    { name: 'interestRate', value: '' },
    { name: 'accountingRule', value: '' },
    { name: 'fundSource', value: '' },
    { name: 'loanPortfolio', value: '' },
    { name: 'interestReceivable', value: '' },
    { name: 'feesReceivable', value: '' },
    { name: 'penaltiesReceivable', value: '' },
    { name: 'overPayments', value: '' },
    { name: 'incomeForInterest', value: '' },
    { name: 'incomeFromFees', value: '' },
    { name: 'incomeFromPenalties', value: '' },
    { name: 'incomeFromRecovery', value: '' },
    { name: 'writtenOff', value: '' },
  ]);

  const fieldUi: FormValues = {
    name: t('forms.fields.field', { name: `Name` }),
    form: t('forms.fields.field', { name: `Loan Form` }),
    principal: t('forms.fields.field', { name: `Principal` }),
    terms: t('forms.fields.field', { name: `Terms` }),
    repaymentCycle: t('forms.fields.field', { name: `Repayment Cycle` }),
    interestRate: t('forms.fields.field', { name: `Interest Rate` }),
    accountingRule: t('forms.fields.field', { name: `Accounting Rule` }), //
    fundSource: t('forms.fields.field', { name: `Fund Source` }),
    loanPortfolio: t('forms.fields.field', { name: `Loan Portfolio` }),
    interestReceivable: t('forms.fields.field', { name: `Interest Receivable` }),
    feesReceivable: t('forms.fields.field', { name: `Fees Receivable` }),
    penaltiesReceivable: t('forms.fields.field', { name: `Penalties Receivable` }),
    overPayments: t('forms.fields.field', { name: `Over Payments` }),
    incomeForInterest: t('forms.fields.field', { name: `Income for Interest` }),
    incomeFromFees: t('forms.fields.field', { name: `Income from Fees` }),
    incomeFromPenalties: t('forms.fields.field', { name: `Income from Penalties` }),
    incomeFromRecovery: t('forms.fields.field', { name: `Income from Recovery` }),
    writtenOff: t('forms.fields.field', { name: `Written Off` }),
  };

  const handleSubmit = (e: any) => {
    e.preventDefault();
    setIsLoading(true);
    form
      .validateFields()
      .then(() => {
        setTimeout(() => {
          notificationController.success({ message: t('common.success') });
          setIsLoading(false);
          setOpen(!open);
        }, 3000);
      })
      .catch(() => {
        notificationController.error({ message: t('common.error') });
        setIsLoading(false);
      });
  };

  return (
    <Spinner spinning={isLoading} size={'large'}>
      <BaseForm
        name={`${name}Form`}
        form={form}
        fields={fields}
        onFieldsChange={(_, allFields) => {
          const currentFields = allFields.map((item) => ({
            name: Array.isArray(item.name) ? item.name[0] : '',
            value: item.value,
          }));
          const uniqueData = mergeBy(fields, currentFields, 'name');
          setFields(uniqueData);
        }}
      >
        <S.FormContent>
          <Row justify={'space-between'} align={'middle'}>
            <Col xxl={12}>
              <BaseForm.Item
                name="name"
                label={fieldUi.name}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Loan Name`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.name} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="form"
                label={fieldUi.form}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Loan Form`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.form} />
              </BaseForm.Item>
            </Col>
            <Col xxl={12}>
              <BaseForm.Item
                name="principal"
                label={fieldUi.principal}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Principal Amount`,
                    }),
                  },
                ]}
              >
                <InputNumber placeholder={fieldUi.principal} min={0} style={{ width: 320 }}/>
              </BaseForm.Item>
            </Col>
          </Row>
          <Row justify={'space-between'} align={'middle'}>
            <Col xxl={12}>
              <BaseForm.Item
                name="terms"
                label={fieldUi.terms}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Loan Terms`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.terms} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="repaymentCycle"
                label={fieldUi.repaymentCycle}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Repayment Cycle`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.repaymentCycle} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="interestRate"
                label={fieldUi.interestRate}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Interest Rate`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={`${fieldUi.interestRate} `} />
              </BaseForm.Item>
            </Col>
          </Row>
          <Divider />
          <Typography.Text>Accounting</Typography.Text>
          <Row justify={'space-between'} align={'middle'}>
            <Col xxl={12}>
              <BaseForm.Item
                name="accountingRule"
                label={fieldUi.accountingRule}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Accounting Rule`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.accountingRule} />
              </BaseForm.Item>
            </Col>
          </Row>
          <Typography.Text>Assets</Typography.Text>
          <Row justify={'space-between'} align={'middle'}>
            <Col>
              <BaseForm.Item
                name="fundSource"
                label={fieldUi.fundSource}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Fund Source`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.fundSource} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="loanPortfolio"
                label={fieldUi.loanPortfolio}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Loan Portfolio`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={`${fieldUi.loanPortfolio} `} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="interestReceivable"
                label={fieldUi.interestReceivable}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Interest Receivable`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.interestReceivable} />
              </BaseForm.Item>
            </Col>
          </Row>
          <Row justify={'space-between'} align={'middle'}>
            <Col>
              <BaseForm.Item
                name="feesReceivable"
                label={fieldUi.feesReceivable}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Fees Receivable`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.feesReceivable} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="penaltiesReceivable"
                label={fieldUi.penaltiesReceivable}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Penalties Receivable`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={`${fieldUi.penaltiesReceivable} `} />
              </BaseForm.Item>
            </Col>
            <Col></Col>
          </Row>
          <Typography.Text>Liabilities</Typography.Text>
          <Row justify={'space-between'} align={'middle'}>
            <Col>
              <BaseForm.Item
                name="overPayments"
                label={fieldUi.overPayments}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Over Payments`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.overPayments} />
              </BaseForm.Item>
            </Col>
          </Row>
          <Typography.Text>Income</Typography.Text>
          <Row justify={'space-between'} align={'middle'}>
            <Col>
              <BaseForm.Item
                name="incomeForInterest"
                label={fieldUi.incomeForInterest}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Income for Interest`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.incomeForInterest} />
              </BaseForm.Item>
            </Col>
            <Col>
              <BaseForm.Item
                name="incomeFromFees"
                label={fieldUi.incomeFromFees}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Income from Fees`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={`${fieldUi.incomeFromFees} `} />
              </BaseForm.Item>
            </Col>
            <Col xxl={12}>
              <BaseForm.Item
                name="incomeFromRecovery"
                label={fieldUi.incomeFromRecovery}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Income from Recovery`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.incomeFromRecovery} />
              </BaseForm.Item>
            </Col>
          </Row>
          <Row justify={'space-between'} align={'middle'}>
            <Col xxl={12}>
              <BaseForm.Item
                name="incomeFromRecovery"
                label={fieldUi.incomeFromRecovery}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Income from Recovery`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.incomeFromRecovery} />
              </BaseForm.Item>
            </Col>
            <Col xxl={12}>
              <BaseForm.Item
                name="incomeFromRecovery"
                label={fieldUi.incomeFromRecovery}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Income from Recovery`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.incomeFromRecovery} />
              </BaseForm.Item>
            </Col>
            <Col></Col>
          </Row>
          <Typography.Text>Expenses</Typography.Text>
          <Row>
            <Col>
              <BaseForm.Item
                name="writtenOff"
                label={fieldUi.writtenOff}
                rules={[
                  {
                    required: true,
                    message: t('forms.stepFormLabels.fieldError', {
                      field: `Written Off`,
                    }),
                  },
                ]}
                style={{
                  width: 320,
                }}
              >
                <Input placeholder={fieldUi.writtenOff} />
              </BaseForm.Item>
            </Col>
            <Col></Col>
          </Row>
        </S.FormContent>
        <S.ActionWrapper>
          <Button
            type="primary"
            onClick={(e) => handleSubmit(e)}
            loading={isLoading}
            style={{
              width: 150,
            }}
          >
            {!isLoading ? 'Submit' : 'Processing...'}
          </Button>
          {!isLoading ? (
            <Button
              onClick={() => setOpen(!open)}
              style={{
                right: 31,
                position: 'absolute',
                width: 150,
              }}
              danger
            >
              Cancel
            </Button>
          ) : null}
        </S.ActionWrapper>
      </BaseForm>
    </Spinner>
  );
};
